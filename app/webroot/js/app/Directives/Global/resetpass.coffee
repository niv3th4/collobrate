angular.module 'Pyoopil.Directives'
  .controller 'resetpassCtrl', ['$scope', ($scope)->
    $scope.validPass = false
  ]
  .directive 'resetpass', ['$http', ($http)->

    return {

      restrict : 'E',
      scope: {

      },
      controller : 'resetpassCtrl',
      templateUrl : '/pyoopil/js/app/partials/reset-pass-form.html'
      link : (scope, elem, attrs, ctrl)->

        $newPass = angular.element '#reset_pass'
        $newPassConfirm = angular.element '#reset_pass_confirm'
        $submit = angular.element '#submit'
        score = 0

        scope.passStrength = ''
        scope.login = {}

        $newPass.passMeter((score)->
          if score < 40
            scope.passStrength = 'weak'
          else if score < 90
            scope.passStrength = 'medium'
          else
            scope.passStrength = 'strong'

          if not scope.$$phase
            scope.$digest()
        )

        scope.$watch 'login.reset_pass_confirm', (newVal, oldVal)->
          if newVal isnt oldVal
            if scope.passStrength? and ( scope.login.reset_pass is scope.login.reset_pass_confirm )
              scope.validPass = true
            else
              scope.validPass = false

        $submit.on 'click', (e)->
          e.preventDefault()

#          xhr = $http.post('http://www.google.com/recaptcha/api/verify', {
#            "privatekey" : "6LeO9fcSAAAAAAOVAFjxK-urHprb-IkKkSYwY21N",
#            "remoteip" : "http://127.0.0.1",
#            "challenge" : angular.element("#recaptcha_challenge_image"),
#            "response" : angular.element("#response_challenge_image")
#          })

    }

  ]