angular.module 'Pyoopil.Directives'
.factory 'Tiles', ['$timeout', ($timeout)->

  class Tiles
    constructor : ->
      return {
      restrict : 'E',
      templateUrl : '/pyoopil/js/app/partials/Classrooms/classroom-tile.html'
      }
]