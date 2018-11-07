angular.module 'Pyoopil.Directives'
.directive 'reply', [ ()->

  restrict : 'A'
  scope: {
    reply : '='
  }
  templateUrl : '/pyoopil/js/app/partials/sandbox/reply.html',
  link : (scope, elem, attrs)->

#    console.log scope


]