angular.module 'Pyoopil.Directives'
.directive 'discussionType', ['EventEmitter', 'Notify', (EventEmitter, Notify)->

  restrict : 'A',
  scope:{
    discussionType: '='
  }
  link : (scope, elem, attrs)->

    new class Type extends EventEmitter

      constructor : ->

        @init()

        elem.addClass @$scope.discussionType.class

      init : ->

        super scope

        elem.on 'click', (evt) => @broadcast('UPDATE.DiscussionType', @$scope.discussionType)




]