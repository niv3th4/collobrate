angular.module 'Pyoopil.Directives'
.directive 'discussions', ['EventEmitter', 'Notify', (EventEmitter, Notify)->

  restrict : 'E',
  templateUrl : '/pyoopil/js/app/partials/Classrooms/discussion.html',
  link : (scope, elem, attrs)->

    new class Discussions

      constructor : ->

        scope.discussions = []
        @isInitial = true

        @addListeners()

      addListeners : ->

        scope.$on 'READ.Discussions', (evt, data) => @renderDiscussions evt, data
        scope.$on 'REMOVE.Discussion', (evt, id) => @removeDiscussion id

      renderDiscussions : (evt, discussions) ->

        if _.isEmpty(discussions)
          Notify.alert 'No More Discussions to load', 'error'
          return

        angular.forEach(discussions, (discussion)=>
          if @isInitial
            scope.discussions.push discussion
          else
            scope.discussions.unshift discussion
        )

        @isInitial = false

      removeDiscussion : (id)->

        scope.discussions = _.reject scope.discussions, (discussion)->
          discussion.Discussion.id is id

]