angular.module('Pyoopil.Directives')
  .controller 'scrollbarCtrl', ['$scope', ($scope)->

    $scope.hasScrollReached = false

  ]
  .directive('scrollbar', [()->

    return {

      restrict : 'A'
      link : (scope, elem, attrs)->

        $tsb = angular.element '.tinyscrollbar'
        $vp = $tsb.find '.viewport'
        $tsb.tinyscrollbar({thumbSize: 34})

        $tinyscrollbar = $tsb.data("plugin_tinyscrollbar")

        scope.$on 'UPDATE.Scroll', (evt, isRelative)->

            scope.hasScrollReached = false

            if isRelative? and isRelative
              $tinyscrollbar.update('relative')
            else
              $tinyscrollbar.update()

        $vp.on 'endOfScroll', (e)->

          if not scope.hasScrollReached
            scope.hasScrollReached = true
            scope.$emit 'END.Scroll'
    }


  ])