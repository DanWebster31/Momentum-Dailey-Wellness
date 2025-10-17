// Register the interest list form
formRegistry.register({
  formID: '#interest-list',
  errorMessageDIV: '#errorchecking',
  checkBoxClassName: '',
  checkBoxGroupName: '',
  checkBoxGroupName2: '',
  checkBoxGroupName3: '',
  radioBtnGroupName: '',
  submitButtonID: '#submitbutton',
  formActionURL: '/wp-content/themes/client-theme/includes/php/process.php',
  //formActionURL: '/admin-panel/interest-list/webservice/process.php',
  googleAnalyticsCode: {
    label: 'interest_list_submission'
  },
  successMessage: {
    title: 'Thank you for your Interest',
    copy: 'Your information has been received.'
  },
  processingMessage: {
    title: 'Processing',
    copy: 'Please wait a moment.',
    loader: '/wp-content/themes/client-theme/images/global/loader.svg'
  },
  recaptchaSiteKey: '6LefZOMrAAAAANJC2HSU_N4xn-1t7D68yYHqktl_',
  recaptchaContainerId: 'recaptcha-container'
});


/*********************************
* TEXTAREA AUTO HEIGHT
*********************************/

function adjustTextAreaHeight(textArea) {
  // Reset height to auto to get proper scrollHeight measurement
  textArea.style.height = 'auto';
  
  // Set the height to match content plus a small buffer
  textArea.style.height = (textArea.scrollHeight + 2) + 'px';
}

// Make the function globally available
window.adjustTextAreaHeight = adjustTextAreaHeight;

// Initialize textarea heights on page load
$(document).ready(function() {
  $('textarea').each(function() {
    if ($(this).val()) {
      adjustTextAreaHeight(this);
    }
  });
});

