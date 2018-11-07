angular.module('Pyoopil.Directives')
.directive('login', ['$state', 'Utilities',  ($state, Utilities)->

    return {

    restrict : 'E',
    template : '<button name="login_btn" value="login" id="dialog-link">Login</button>'
    link : (scope, elem, attrs)->

      elem.on 'click', ->
        Utilities.openModal('login')

      $resetPass = elem.find '#for-pass'

      $resetPass.on 'click', (e)->
        e.preventDefault()
        Utilities.closeModal()
        $state.go 'reset'

        false

    }


  ])