<?php

myvox_load_js('myvox.password_extended');

$setting['minSymbols'] = myvox_get_plugin_setting('use_symbols', 'password_extended');
$setting['minNumbers'] = myvox_get_plugin_setting('use_numbers', 'password_extended');
$setting['minLowerCaseLetters'] = myvox_get_plugin_setting('use_lowercase', 'password_extended');
$setting['minUpperCaseLetters'] = myvox_get_plugin_setting('use_uppercase', 'password_extended');
$setting['minLength'] = myvox_get_plugin_setting('password_lenght_min', 'password_extended');
$setting['maxLength'] = myvox_get_plugin_setting('max_lenght_password', 'password_extended');

$use_symbols_value = ($setting['minSymbols'] == 'yes') ? myvox_get_plugin_setting('use_symbols_value', 'password_extended') : 0;
$use_numbers_value = ($setting['minNumbers'] == 'yes') ? myvox_get_plugin_setting('use_numbers_value', 'password_extended') : 0;
$use_lowercase_value = ($setting['minLowerCaseLetters'] == 'yes') ? myvox_get_plugin_setting('use_lowercase_value', 'password_extended'): 0;
$use_uppercase_value = ($setting['minUpperCaseLetters'] == 'yes') ? myvox_get_plugin_setting('use_uppercase_value', 'password_extended'): 0;

$password_min_lenght_value = ($setting['minLength'] == 'yes') ? myvox_get_plugin_setting('password_min_lenght_value', 'password_extended') : 6;
$password_max_lenght_value = ($setting['maxLength'] == 'yes') ? myvox_get_plugin_setting('password_max_lenght_value', 'password_extended'): 50;
?>

<div class="myvox-module myvox-module-info">
    <div class="myvox-body">
        <div class="myvox-head"><br></div>
        <div class="profile_manager_register_input_container">
            <input value="<?= $vars['guid']; ?>" id="guid" name="guid" type="hidden">
            <span
                class="profile_manager_validate_icon fa-pulse hidden myvox-icon-spinner myvox-icon fa fa-spinner"></span>
        </div>
    </div>

    <div class="myvox-field">
        <label for="register-password1"><?php echo myvox_echo('password_extended:current_password'); ?></label>
        <div class="profile_manager_register_input_container">
            <input value="<?= $vars['password']; ?>" autocapitalize="off" autocomplete="off" autocorrect="off" id="oldpassword" required="true"
                   autocomplete="off" name="oldpassword"
                   class="myvox-input-password" type="password">

        </div>
    </div>

    <div class="myvox-field">
        <label for="register-password2"><?php echo myvox_echo('password_extended:new_password'); ?></label>
        <div class="profile_manager_register_input_container">
            <input value="" autocapitalize="off" autocorrect="off"  autocomplete="off" id="password" name="password" required="true"
                   maxlength="<?= ($setting['maxLength']=='yes') ? $password_max_lenght_value : '' ?>"
                   class="myvox-input-password" type="password">

        </div>
        <div id="pass-info">
        </div>
    </div>
    <div id="retype_password" class="myvox-field">
        <label for="register-password2"><?php echo myvox_echo('password_extended:retype_password'); ?></label>
        <div class="profile_manager_register_input_container">
            <input value="" autocapitalize="off" autocorrect="off" autocomplete="off" id="password2" name="password2"
                   maxlength="<?= ($setting['maxLength']=='yes') ? $password_max_lenght_value : '' ?>"
                   class="myvox-input-password" type="password">

        </div>
    </div>
</div>

<div id="container">
    <div id="pswd_info">
        <h4><?php echo myvox_echo('password_extended:requirements'); ?></h4>
        <ul>
                <span id="valid_length"
                      class="invalid"><?php echo ($setting['minLength']==='yes') ? myvox_echo('password_extended:require:long', [$password_min_lenght_value]) :''; ?></span>

            <span id="valid_number"
                  class="invalid"><?php echo ($setting['minNumbers']==='yes') ? myvox_echo('password_extended:require:numbers', [$use_numbers_value]) : ''; ?></span>

            <span id="valid_symbol"
                  class="invalid"><?php echo ($setting['minSymbols']==='yes') ? myvox_echo('password_extended:require:symbols', [$use_symbols_value]) : ''; ?></span><br>

            <span id="valid_lower"
                  class="invalid"><?php echo ($setting['minLowerCaseLetters']==='yes') ? myvox_echo('password_extended:require:lowercase', [$use_lowercase_value]) : ''; ?></span>

            <span id="valid_capital"
                  class="invalid"><?php echo ($setting['minUpperCaseLetters']==='yes') ? myvox_echo('password_extended:require:uppercase', [$use_uppercase_value]) : ''; ?></span>
        </ul>
    </div>
</div>

<div class="myvox-foot">
    <?php echo myvox_view('input/submit', array('value' => myvox_echo('password_extended:renew'))); ?>
</div>

<script type="text/javascript">

    /**
     *
     * @param password
     * @param password2
     * @param passwordsInfo
     */
    function passwordStrengthCheck(password, password2, passwordsInfo) {
        //Must contain 5 characters or more
        var WeakPass = /(?=.{<?= $password_min_lenght_value; ?>,}).*/;
        var Lock = 0;

        //Must contain lower case letters and at least one digit.
        var MediumPass = /^(?=\S*?[a-z])(?=\S*?[0-9])\S{5,}$/;

        //Must contain at least one upper case letter, one lower case letter and one digit.
        var StrongPass = /^(?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9])\S{5,}$/;

        //Must contain at least one upper case letter, one lower case letter and one digit.
        var VryStrongPass = /^(?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9])(?=\S*?[^\w\*])\S{5,}$/;

        var MinNumbers = /^(?=\S*?[0-9])\S{<?= trim($use_numbers_value); ?>,}$/;
        var MinNumbers_Skip = '<?= ($setting['minNumbers']=='yes') ? 'yes' : 'no'; ?>';
        var MinSymbols = /\W{<?= trim($use_symbols_value); ?>,}/;
        var MinSymbols_Skip = '<?= ($setting['minSymbols']=='yes') ? 'yes' : 'no'; ?>';

        var MinLowerCase = /^(?=\S*?[a-z])\S{<?= trim($use_lowercase_value); ?>,}$/;
        var MinLowerCase_Skip = '<?= ($setting['minLowerCaseLetters']=='yes') ? 'yes' : 'no'; ?>';
        var MinUpperCase = /^(?=\S*?[A-Z])\S{<?= trim($use_uppercase_value); ?>,}$/;
        var MinUpperCase_Skip = '<?= ($setting['minUpperCaseLetters']=='yes') ? 'yes' : 'no'; ?>';

        $(password).keyup( function (e) {
            var counter = 0;

            if (VryStrongPass.test(password.val())) {
                passwordsInfo.removeClass().addClass('vrystrongpass').html("<?= myvox_echo('script:strong:very', []); ?>");
                document.getElementById('retype_password').style.display = "block";
            }
            else if (StrongPass.test(password.val())) {
                passwordsInfo.removeClass().addClass('strongpass').html("<?= myvox_echo('script:strong', []); ?>");
                document.getElementById('retype_password').style.display = "none";
            }
            else if (MediumPass.test(password.val())) {
                passwordsInfo.removeClass().addClass('goodpass').html("<?= myvox_echo('script:good', []); ?>");
                document.getElementById('retype_password').style.display = "none";
            }
            else if (WeakPass.test(password.val())) {
                passwordsInfo.removeClass().addClass('stillweakpass').html("<?= myvox_echo('script:weak', []); ?>");
                document.getElementById('retype_password').style.display = "none";
            }
            else {
                passwordsInfo.removeClass().addClass('weakpass').html("<?= myvox_echo('script:short', [$password_min_lenght_value]); ?>");
                document.getElementById('retype_password').style.display = "none";
            }

            if (MinSymbols.test(password.val()) || MinSymbols_Skip == 'no') {
                counter++;
                document.getElementById('valid_symbol').removeAttribute('class');
                document.getElementById('valid_symbol').setAttribute('class', 'valid');
            } else {
                document.getElementById('valid_symbol').removeAttribute('class');
                document.getElementById('valid_symbol').setAttribute('class', 'invalid');
            }

            if (WeakPass.test(password.val())) {
                counter++;
                document.getElementById('valid_length').removeAttribute('class');
                document.getElementById('valid_length').setAttribute('class', 'valid');
            } else {
                document.getElementById('valid_length').removeAttribute('class');
                document.getElementById('valid_length').setAttribute('class', 'invalid');
            }

            if (MinNumbers.test(password.val()) || MinNumbers_Skip == 'no') {
                counter++;
                document.getElementById('valid_number').removeAttribute('class');
                document.getElementById('valid_number').setAttribute('class', 'valid');
            } else {
                document.getElementById('valid_number').removeAttribute('class');
                document.getElementById('valid_number').setAttribute('class', 'invalid');
            }

            if (MinLowerCase.test(password.val()) || MinLowerCase_Skip == 'no') {
                counter++;
                document.getElementById('valid_lower').removeAttribute('class');
                document.getElementById('valid_lower').setAttribute('class', 'valid');
            } else {
                document.getElementById('valid_lower').removeAttribute('class');
                document.getElementById('valid_lower').setAttribute('class', 'invalid');
            }

            if (MinUpperCase.test(password.val()) || MinUpperCase_Skip == 'no') {
                counter++;
                document.getElementById('valid_capital').removeAttribute('class');
                document.getElementById('valid_capital').setAttribute('class', 'valid');
            } else {
                document.getElementById('valid_capital').removeAttribute('class');
                document.getElementById('valid_capital').setAttribute('class', 'invalid');
            }

            if(counter >= 5){
                document.getElementById('retype_password').style.display = "block";
                document.getElementById('pswd_info').style.display = "none";
            }else{
                document.getElementById('pswd_info').style.display = "block";
            }
        });

        $(password2).keyup( function (e) {

            if (password.val() !== password2.val()) {
                passwordsInfo.removeClass().addClass('weakpass').html("<?= myvox_echo('script:mismatch')?>");
            } else {
                passwordsInfo.removeClass().addClass('vrystrongpass').html("<?= myvox_echo('script:matched')?>");
            }

        });
    }

</script>