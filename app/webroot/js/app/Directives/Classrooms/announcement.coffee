angular.module 'Pyoopil.Directives'
.directive 'announcement', ['announcementService', (announcementService)->

  restrict : 'A'
  scope: {
    announcement : '='
  }
  link : (scope, elem, attrs)->

    if scope.$parent.$last
      announcementService.rendered()



]