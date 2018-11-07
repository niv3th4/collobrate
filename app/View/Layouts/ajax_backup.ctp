<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script> 
<link href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/css/toastr.min.css" rel="stylesheet"/>
<script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>	
<?php
$flashMessage = $this->Session->flash('auth');
if ($flashMessage !== false) {
    echo $this->element('flash', array(
        'message' => $flashMessage
    ));
}

$flashMessage = $this->Session->flash();
if ($flashMessage !== false) {
    echo $this->element('flash', array(
        'message' => $flashMessage
    ));
}
?>
<?php echo $this->fetch('content'); ?>
