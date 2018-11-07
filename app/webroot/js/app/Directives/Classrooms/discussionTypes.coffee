angular.module 'Pyoopil.Directives'
.directive 'discussionTypes', ['EventEmitter', 'Notify', (EventEmitter, Notify)->

  restrict : 'E',
  template : '<a ng-repeat="type in types" class="ques-icon" discussion-type="type"></a>',
  link : (scope, elem, attrs)->

    new class DiscussionTypes

      constructor : ->

        scope.types = [
          {
            'name' : 'question',
            'class' : 'ques',
            'dialog' : 'ques-box'
          },
          {
            'name' : 'poll',
            'class' : 'poll'
            'dialog' : 'poll-box'
          },
          {
            'name' : 'note',
            'class' : 'note-icon',
            'dialog' : 'note-box'
          }
        ]


]