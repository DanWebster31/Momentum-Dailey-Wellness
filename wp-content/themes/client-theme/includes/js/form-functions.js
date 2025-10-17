/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
  FORM FUNCTIONS
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

class ValidationForm {
    constructor(options) {
      console.log('ValidationForm constructor called with options:', options);
      this.$submitBtn = $(options.submitButtonID);
      this.$form = $(options.formID);
      this.$requiredFields = $(options.formID + ' [required]');
      this.$errorChecking = $(options.formID + ' ' + options.errorMessageDIV);
      this.checkBoxClassName = options.checkBoxClassName || '';
      this.checkBoxGroupName = options.checkBoxGroupName || '';
      this.checkBoxGroupName2 = options.checkBoxGroupName2 || '';
      this.checkBoxGroupName3 = options.checkBoxGroupName3 || '';
      this.radioBtnGroupName = options.radioBtnGroupName || '';
      this.formActionURL = options.formActionURL;
      this.googleAnalyticsCode = options.googleAnalyticsCode || null;
      this.isSubmitting = false;
      this.successMessage = options.successMessage || {
        title: 'Success',
        copy: 'Your message has been received',
      };
      this.processingMessage = options.processingMessage || {
        title: 'Processing',
        copy: 'Please wait.',
        loader: '/wp-content/themes/client-theme/images/global/loader.svg'
      };
      this.formId = options.formID.replace('#', '');
      this.recaptchaWidgetId = null;
      this.recaptchaSiteKey = options.recaptchaSiteKey;
      this.recaptchaContainerId = options.recaptchaContainerId || 'recaptcha-container';
  
      if(!this.recaptchaSiteKey) {
        console.error(`[Form ${this.formId}] No reCAPTCHA site key provided`);
      }
    }
  
    isEmail(email) {
      const regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      return regex.test(email);
    }
  
    isTel(tel) {
      // Accepts 10 digits, optional spaces, dashes, parentheses, leading +1
      return /^\+?1?[-.\s]?\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}$/.test(tel);
    }
  
    init() {
      console.log(`[Form ${this.formId}] Initializing form`);
      this.bindEvents();
      this.initializeRecaptcha();
    }
  
    bindEvents() {
      this.$form.on('submit', (e) => {
        e.preventDefault();
        this.submitForm(e);
      });
  
      this.$submitBtn.on('click', (e) => {
        e.preventDefault();
        this.$form.submit();
      });
    }
  
    initializeRecaptcha() {
      if (!this.$form.hasClass("rc-validate")) {
        console.log(`[Form ${this.formId}] No reCAPTCHA required`);
        return;
      }
  
      const container = document.getElementById(this.recaptchaContainerId);
      if (!container) {
        console.error(`[Form ${this.formId}] reCAPTCHA container not found`);
        return;
      }
  
      // Try to initialize immediately
      this.tryInitializeRecaptcha(container);
  
      // Also set up a retry mechanism
      let retryCount = 0;
      const maxRetries = 5;
      const retryInterval = 1000; // 1 second
  
      const retryTimer = setInterval(() => {
        if (this.recaptchaWidgetId !== null && typeof this.recaptchaWidgetId !== 'undefined') {
          console.log(`[Form ${this.formId}] reCAPTCHA already initialized with widget ID:`, this.recaptchaWidgetId);
          clearInterval(retryTimer);
          return;
        }
  
        if (retryCount >= maxRetries) {
          console.log(`[Form ${this.formId}] Max retries reached for reCAPTCHA initialization`);
          clearInterval(retryTimer);
          return;
        }
  
        console.log(`[Form ${this.formId}] Retrying reCAPTCHA initialization (attempt ${retryCount + 1})`);
        this.tryInitializeRecaptcha(container);
        retryCount++;
      }, retryInterval);
    }
  
    tryInitializeRecaptcha(container) {
      try {
        // Check if already rendered
        if (this.recaptchaWidgetId !== null && typeof this.recaptchaWidgetId !== 'undefined') {
          console.log(`[Form ${this.formId}] reCAPTCHA already initialized with widget ID:`, this.recaptchaWidgetId);
          return;
        }
  
        // Check if grecaptcha is available
        if (typeof grecaptcha === 'undefined') {
          console.log(`[Form ${this.formId}] grecaptcha not yet available`);
          return;
        }
  
        // Check if container is visible
        const isVisible = !this.$form.is(':hidden') && this.$form.parents(':hidden').length === 0;
        if (!isVisible) {
          console.log(`[Form ${this.formId}] Form is not visible, skipping reCAPTCHA initialization`);
          return;
        }
  
        // Try to render reCAPTCHA
        this.recaptchaWidgetId = grecaptcha.render(container, {
          sitekey: this.recaptchaSiteKey,
          size: 'invisible',
          callback: (token) => this.handleRecaptchaCallback(token)
        });
        console.log(`[Form ${this.formId}] reCAPTCHA initialized with widget ID:`, this.recaptchaWidgetId);
      } catch (error) {
        console.error(`[Form ${this.formId}] Error initializing reCAPTCHA:`, error);
      }
    }
  
    // Add a public method to force reCAPTCHA initialization
    forceRecaptchaInit() {
      const container = document.getElementById(this.recaptchaContainerId);
      if (container) {
        this.tryInitializeRecaptcha(container);
      }
    }
  
    submitForm(event) {
      if (event) {
        event.preventDefault();
      }
      
      console.log(`[Form ${this.formId}] Submission started`);
      
      if (this.isSubmitting) {
        console.log(`[Form ${this.formId}] Already submitting`);
        return;
      }
      
      if (!this.validate()) {
        console.log(`[Form ${this.formId}] Validation failed`);
        return;
      }
  
      console.log(`[Form ${this.formId}] Validation passed`);
      this.isSubmitting = true;
      this.$submitBtn.prop('disabled', true);
      this.showProcessingMessage();
  
      if (this.$form.hasClass("rc-validate")) {
        try {
          if (typeof grecaptcha === 'undefined') {
            throw new Error('reCAPTCHA not loaded');
          }
          grecaptcha.execute(this.recaptchaWidgetId);
        } catch (error) {
          console.error(`[Form ${this.formId}] reCAPTCHA error:`, error);
          this.handleError('Error verifying reCAPTCHA. Please try again.');
          this.resetForm();
        }
      } else {
        const formData = this.$form.serialize();
        this.submitAjax(formData);
      }
    }
  
    handleRecaptchaCallback(token) {
      if (!token) {
        this.handleError('reCAPTCHA verification failed. Please try again.');
        this.resetForm();
        return;
      }
  
      const formData = this.$form.serialize() + '&g-recaptcha-response=' + token;
      this.submitAjax(formData);
    }
  
    submitAjax(dataString) {
      if (!dataString) {
        console.error(`No data string provided for form ${this.formId} submission`);
        this.handleError('An error occurred. Please try again.');
        this.resetForm();
        return;
      }
  
      console.log(`Submitting form data via AJAX for form ${this.formId}`);
      
      if (this.$form.hasClass("rc-validate") && !dataString.includes('g-recaptcha-response=')) {
        console.error(`Missing reCAPTCHA token in form ${this.formId} submission`);
        this.handleError('Please complete the reCAPTCHA verification.');
        this.resetForm();
        if (typeof grecaptcha !== 'undefined' && grecaptcha.reset) {
          grecaptcha.reset();
        }
        return;
      }
      
      $.ajax({
        type: 'POST',
        url: this.formActionURL,
        data: dataString,
        dataType: 'text',
        success: (response) => {
          console.log(`Form ${this.formId} submitted successfully with response:`, response ? response : '(empty response)');
          this.showSuccessMessage();
          if (this.googleAnalyticsCode && this.googleAnalyticsCode.label) {
            window.dataLayer = window.dataLayer || [];
            window.dataLayer.push({
              'event': 'interest_list',
              'form_name': this.googleAnalyticsCode.label
            });
            console.log('Google Analytics event pushed ' + this.googleAnalyticsCode.label);
          }
          
        },
        error: (xhr, status, error) => {
          console.error(`Form ${this.formId} submission error:`, error);
          
          // Only treat empty responses as success if status is 200
          if (xhr.status === 200 && (
              error === 'SyntaxError: Unexpected end of JSON input' || 
              xhr.responseText === '' || 
              xhr.responseText === null)) {
            console.log(`Server returned successful response for form ${this.formId}, showing success`);
            this.showSuccessMessage();
          } else {
            console.error(`Server error (${xhr.status}):`, xhr.responseText);
            this.handleError('There was an error submitting the form. Please try again.');
            if (typeof grecaptcha !== 'undefined' && grecaptcha.reset) {
              grecaptcha.reset();
            }
          }
        },
        complete: () => {
          console.log(`Ajax request completed for form ${this.formId}`);
          this.resetForm();
        }
      });
    }
  
    validate() {
      let isValid = true;
      this.$errorChecking.removeClass('hidden').hide();
      let emptyFields = [];
  
      // Remove any existing required-highlight classes
      this.$form.find('.fielditem').removeClass('required-highlight');
  
      // Validate required fields
      this.$requiredFields.each((index, field) => {
        const $field = $(field);
        const type = $field.attr('type');
        const name = $field.attr('name');
        const value = $field.val();
        
        if (type === 'checkbox' || type === 'radio') return; // handled below
        
        if (!value || (typeof value === 'string' && !value.trim())) {
          isValid = false;
          const label = $field.prev('label').text().replace('*', '').trim() || name;
          emptyFields.push(label);
          $field.closest('.fielditem').addClass('required-highlight');
        }
        
        // Validate email
        if (type === 'email' && value && typeof value === 'string' && value.trim() && !this.isEmail(value.trim())) {
          isValid = false;
          const label = $field.prev('label').text().replace('*', '').trim() || name;
          emptyFields.push(label + ' (invalid email)');
          $field.closest('.fielditem').addClass('required-highlight');
        }
        
        // Validate tel
        if (type === 'tel' && value && typeof value === 'string' && value.trim() && !this.isTel(value.trim())) {
          isValid = false;
          const label = $field.prev('label').text().replace('*', '').trim() || name;
          emptyFields.push(label + ' (invalid phone)');
          $field.closest('.fielditem').addClass('required-highlight');
        }
      });
  
      // Validate checkbox groups only if they are defined and not empty
      if (this.checkBoxGroupName && typeof this.checkBoxGroupName === 'string' && this.checkBoxGroupName.trim() !== '') {
        const $checkboxes = this.$form.find(`input[name="${this.checkBoxGroupName}"]`);
        if ($checkboxes.length && !$checkboxes.is(':checked')) {
          isValid = false;
          emptyFields.push('Please select at least one option');
          $checkboxes.closest('.fieldlist').addClass('required-highlight');
        }
      }
  
      // Validate radio groups only if they are defined and not empty
      if (this.radioBtnGroupName && typeof this.radioBtnGroupName === 'string' && this.radioBtnGroupName.trim() !== '') {
        const $radios = this.$form.find(`input[name="${this.radioBtnGroupName}"]`);
        if ($radios.length && !$radios.is(':checked')) {
          isValid = false;h2
          emptyFields.push('Please select an option');
          $radios.closest('.fieldlist').addClass('required-highlight');
        }
      }
  
      if (!isValid) {
        let errorHtml = '<p><i class="fas fa-exclamation-circle" aria-hidden="true"></i>&nbsp; <span class="font-main tbase">Please enter the required fields below:</span>';
        if (emptyFields.length > 0) {
          emptyFields.forEach(field => {
            errorHtml += `<br>${field}*`;
          });
        }
        errorHtml += '</p>';
        
        this.$errorChecking.html(errorHtml).slideDown(300);
        $('html, body').animate({
          scrollTop: this.$errorChecking.offset().top - 20
        }, 500);
      }
  
      return isValid;
    }
  
    showProcessingMessage() {
      const iheight = this.$form.outerHeight(false);
      this.$form.css('height', iheight + 'px');
      this.$form.fadeOut(1000, () => {
        this.$form.empty().html(this.buildProcessingMessage()).fadeIn();
      });
      this.scrollToForm();
    }
  
    showSuccessMessage() {
      this.$form.fadeOut(() => {
        this.$form.empty().html(this.buildSuccessMessage()).fadeIn();
        if (this.$form[0] && this.$form[0].reset) {
          this.$form[0].reset();
        }
      });
    }
  
    buildProcessingMessage() {
      return `
        <div class="process" role="alert">
          <h2>${this.processingMessage.title}</h2>
          <p>${this.processingMessage.copy}</p>
          <img class="form-loader" src="${this.processingMessage.loader}" alt="Loading..." />
        </div>
      `;
    }
  
    buildSuccessMessage() {
      return `
        <div class="success" role="alert">
          <h2>${this.successMessage.title}</h2>
          <p>${this.successMessage.copy}</p>
        </div>
      `;
    }
  
    handleError(message) {
      this.$errorChecking.html(`<p><i class="fas fa-exclamation-circle" aria-hidden="true"></i>&nbsp; ${message}</p>`).slideDown(300);
    }
  
    resetForm() {
      this.isSubmitting = false;
      this.$submitBtn.prop('disabled', false);
    }
  
    scrollToForm() {
      $('html,body').animate(
        {scrollTop: this.$form.offset().top - 100},
        1000
      );
    }
  }
  
  // --- Form Initialization Function ---
  function initializeForm(options) {
    // Hide the reCAPTCHA container if specified
    if (options.recaptchaContainerId) {
      const recaptchaContainer = document.getElementById(options.recaptchaContainerId);
      if (recaptchaContainer) {
        recaptchaContainer.style.display = 'none';
      }
    }
  
    // Initialize form styling
    initializeFormStyling(options.formID);
  
    // Initialize the form handler
    const form = new ValidationForm(options);
    form.init();
    // Store instance on the DOM element for easy access
    $(options.formID).data('validationFormInstance', form);
    return form;
  }
  
  /*********************************
  * FORM STYLING
  *********************************/
   
  function initializeFormStyling(formSelector) {
    // Remove the # from the selector if it exists
    const formId = formSelector.replace('#', '');
    const $form = $(`#${formId}`);
  }
  
  // Form registry to track forms that need initialization
  const formRegistry = {
    forms: [],
    register: function(formConfig) {
      this.forms.push(formConfig);
    },
    initializeAll: function() {
      this.forms.forEach(formConfig => {
        initializeForm(formConfig);
      });
    }
  };
  
  // --- reCAPTCHA onload callback ---
  function onRecaptchaApiLoaded() {
    formRegistry.initializeAll();
  }
  
  // Check to see if the input fields have a value on load (refresh), if they do apply the focused style
  $ (document).ready (function () {
    var $inputs = $ ('input,textarea');
  console.log($inputs);
    $inputs.each (function (index, input) {
      if (
        $ (input).attr ('type') === 'email' ||
        $ (input).attr ('type') === 'text'
      ) {
        if ($ (input).val () !== '') {
          $ (input)
            .parents ('.fielditem')
            .addClass ('focused')
            .addClass ('filled');
        }
      }
    });
  });
  
  setTimeout (function () {
    $ ('input,textarea').each (function () {
      var elem = $ (this);
      if (elem.val ()) {
        elem.parent ('.fieldItem').addClass ('focused');
      }
    });
  }, 250);
  
  $ ('input,textarea').focus (function () {
    $ (this)
      .parents ('.fielditem')
      // .removeClass ('required-highlight')
      .addClass ('focused');
  });
  
  $( "select" ).change(function() {
    $ (this)
      .parents ('.select')
      .removeClass ('required-highlight')
      .addClass ('focused');
  });
  
  $ ('input,textarea').on ('input', function () {
    // console.log ($(this).attr ('checked'));
    if ($ (this).is ('input[type="checkbox"]:checked')) {
      $ ('.checkboxitem')
        .find ('.control--checkbox');
        // .removeClass ('required-highlight');
    }
    if ($ (this).is ('input[type="radio"]:checked')) {
        $ ('.radioitem')
          .find ('.control--radio');
          // .removeClass ('required-highlight');
      }
    $ (this)
      .parents ('.fielditem')
      // .removeClass ('required-highlight');
      .addClass ('focused');
  });
  
  $ ('input,textarea').blur (function () {
    var inputValue = $ (this).val ();
    if (inputValue == '') {
      $ (this).removeClass ('filled');
      $ (this).parents ('.fielditem').removeClass ('focused');
    } else {
      $ (this).addClass ('filled');
    }
  });