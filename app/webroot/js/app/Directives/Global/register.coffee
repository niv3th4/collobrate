angular.module('Pyoopil.Directives')
  .directive('register', ['mainService', (mainService)->

      return {

        restrict : 'E'
        templateUrl : '/pyoopil/js/app/partials/register.html'
        link : (scope, elem, attrs)->

          $registration = elem.find '#assign-dialog'
          $close = elem.find 'a.close-link'

          scope.register = {}

          scope.submit = (form)->

            toastr.clear()

            if form.$valid
              data = {
                'data[AppUser][firstname]' : scope.register.firstname,
                'data[AppUser][lastname]' : scope.register.lastname,
                'data[AppUser][email]' : scope.register.email,
                'data[AppUser][institution]' : scope.register.institution
              }
              post = mainService.postRegistration(data)

              post.then(
                (data)->
                  toastr.success 'Registration Successful'

              ,
                () -> toastr.error('Registration Failed !')
              )
            ''

          elem.on('click', ->

            scope.$parent.$emit 'openModal'
            $registration.show()

          )

          $close.on 'click', (e)->

            scope.$parent.$emit 'closeModal'
            $registration.hide()

            false
      }


  ])