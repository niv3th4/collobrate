angular.module('Pyoopil.Directives')
.directive('overlay', ['$document', ($document)->

    return {

    restrict : 'E'
    templateUrl : '/pyoopil/js/app/partials/overlay.html'
    link : (scope, elem, attrs)->

      $overlay = elem.find '#overlayScreen'

      scope.$on('openModal', (e)->

        $overlay.fadeIn('slow')

      )

      scope.$on('closeModal', (e)->

        $overlay.fadeOut('fast')

      )

    }


  ])