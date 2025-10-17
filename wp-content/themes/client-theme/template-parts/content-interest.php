<form name="interest-list" id="interest-list" class="form-styles rc-validate clearfix">

    <input name="notification" type="hidden" value="<?php echo get_field('form_email','options'); ?>" />
    <input name="source" type="hidden" value="Website" />
    <input name="community" type="hidden" value="Momentum Dailey Wellness" />
    <input name="apptJWpGaA6Bna74KNg" type="hidden" value="<?php echo time(); ?>" />

    <div id="errorchecking" class="alert hidden">
      <p><i class="fas fa-exclamation-circle"></i>&nbsp; Please enter the required fields below.</p>
    </div>

    <div id="sec1" class="full half-gutter1 clearfix">

      <div class="half left fielditem fieldinput">
        <label for="first_name">First Name*</label>
        <input type="text" class="required" name="first_name" id="first_name" value="" required />
      </div>

      <div class="half right fielditem fieldinput">
        <label for="last_name">Last Name*</label>
        <input type="text" class="required" name="last_name" id="last_name" value="" required />
      </div>

      <div class="half left fielditem fieldinput">
        <label for="email">Email*</label>
        <input type="email" class="required" name="email" id="email" value="" required />
      </div>

      <div class="half right fielditem fieldinput">
        <label for="phone">Phone</label>
        <input type="text" name="phone" id="phone" value=""/>
      </div>

      <div id="comments-input" class="full left fielditem fieldinput">
        <label for="comments">Questions/Comments</label>
        <textarea onkeyup="adjustTextAreaHeight(this)" name="comments" id="comments"></textarea>
      </div>

    </div>

    <div id="recaptcha-container"></div>

    <div id="form-submit" class="clearfix">
      <div class="required-text">*Required</div>
      <button id="submitbutton" class="boxbtn bgaccent with-radius" type="submit">Submit</button>
    </div>

  </form>
