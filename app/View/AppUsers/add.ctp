<h2>Register</h2>
<fieldset>
    <?php
    echo $this->Form->create($model);
    echo $this->Form->input('username', array(
        'label' => __d('users', 'Username')));
    echo $this->Form->input('email', array(
        'label' => __d('users', 'E-mail (used as login)'),
        'error' => array('isValid' => __d('users', 'Must be a valid email address'),
            'isUnique' => __d('users', 'An account with that email already exists'))));
    echo $this->Form->input('password', array(
        'label' => __d('users', 'Password'),
        'type' => 'password'));
    echo $this->Form->input('temppassword', array(
        'label' => __d('users', 'Password (confirm)'),
        'type' => 'password'));
    $tosLink = $this->Html->link(__d('users', 'Terms of Service'), array('controller' => 'pages', 'action' => 'tos', 'plugin' => null));
    echo $this->Form->input('tos', array(
        'label' => __d('users', 'I have read and agreed to ') . $tosLink));
    echo $this->Form->end(__d('users', 'Submit'));
    ?>
</fieldset>