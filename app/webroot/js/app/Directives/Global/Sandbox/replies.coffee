angular.module 'Pyoopil.Directives'
.directive 'replies', ['EventEmitter', 'Notify', (EventEmitter, Notify)->

  restrict : 'E',
  templateUrl : '/pyoopil/js/app/partials/sandbox/replies.html',
  link : (scope, elem, attrs)->

    new class Replies

      constructor : ->

        @addListeners()

      addListeners : ->

        scope.$on 'READ.Replies', (evt, data) => @renderReplies evt, data

      renderReplies : (evt, replies) ->

        if _.isEmpty(replies)
          Notify.alert 'No More Replies to load', 'error'
          return

        angular.forEach(replies, (reply)->
          if reply.hasOwnProperty('Reply')
            scope.replies.unshift reply.Reply
          else
            scope.replies.push reply
        )

]