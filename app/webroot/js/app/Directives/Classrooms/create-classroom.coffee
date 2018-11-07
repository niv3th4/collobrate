angular.module 'Pyoopil.Directives'
  .directive 'createClassroom', ['Utilities', (Utilities)->

      return {
        restrict : 'E',
        replace : true,
        scope : {

        },
        template : '<button class="sub-btn dialogbox" title="create-assign">Create New Classroom</button>',
        link : (scope, elem, attrs)->
          elem.on 'click', (e)->

            Utilities.openModal 'create-classroom-form.html'

            false
      }

  ]