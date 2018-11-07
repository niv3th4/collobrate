angular.module 'Pyoopil.Directives'
.controller 'discussionCtrl', ['$scope', 'discussionService', 'Notify', ($scope, discussionService, Notify)->

  new class DiscussionCtrl

    addReply : (evt, scope)->

      if evt.keyCode isnt 13
        return
      else
        data = {
          'discussion_id' : scope.discussion.Discussion.id
          'comment' : scope.comment
        }

        discussionService.postForm( 'addReply.json', data , (data) -> @emit 'UPDATE.Scroll'; @emit 'READ.Replies', data, scope)

    setGamification : (praise)->

      data = {
        "id" : praise.id,
        "type" : praise.type,
        "vote" : praise.praise
      }

      discussionService.postForm( 'setGamificationVote.json', data , (data) -> Notify.alert 'You successfully Voted', 'success' )

    votePoll : (vote, scope)->

      if scope.canVote
        return
      else
        poll = _.findWhere scope.discussion.Pollchoice, {id: vote}

        poll.votes++

        @renderChart(scope)

        scope.canVote = true

        data = {
          'pollchoice_id' : vote
        }

        discussionService.postForm( 'setPollVote.json', data , (data) -> Notify.alert 'You successfully Voted', 'success' )


    renderChart : (scope)->

        poll = []

        angular.forEach scope.discussion.Pollchoice, (pollChoice)->

          vote = []

          vote.push {v : pollChoice.choice}
          vote.push {v : pollChoice.votes}

          poll.push {c : vote}

        scope.chartObject.data = {
          "cols": [
            {id: 't', label: "Choices", type: "string"},
            {id: 's', label: "Votes", type: "number"}
          ],
          "rows" : poll
        }

    removeDiscussion : (scope)->

      id = scope.discussion.Discussion.id

      scope.$emit 'REMOVE.Discussion', id

      data = {
        type : 'Discussion',
        id : id
      }

      discussionService.postForm( 'delete.json', data , (data) -> @emit 'UPDATE.Scroll';Notify.alert 'You successfully Deleted the Discussion', 'success' )

    foldDiscussion : (scope)->

      scope.discussion.Discussion.isFolded = !scope.discussion.Discussion.isFolded

      discussionService.postForm( 'togglefold.json', {id: scope.discussion.Discussion.id} , (data) -> Notify.alert 'You successfully Folded the Discussion', 'success' )
]
.directive 'discussion', ['EventEmitter', 'Notify', '$sce','discussionService', '$timeout', (EventEmitter, Notify, $sce, discussionService, $timeout)->

  restrict : 'A',
  scope:{
    discussion : '='
  }
  controller : 'discussionCtrl',
  templateUrl : '/pyoopil/js/app/partials/classrooms/discussion-tile.html',
  link : (scope, elem, attrs, ctrl)->

    new class Discussions

      constructor : ->

        scope.discussion.Discussion.body = $sce.trustAsHtml scope.discussion.Discussion.body

        scope.replies = scope.discussion.Reply

        scope.chartObject = {}
        scope.chartObject.type = 'BarChart'

        ctrl.renderChart(scope)

        scope.canVote = scope.discussion.Discussion.showPollVote

        scope.addReply = (evt)-> ctrl.addReply evt, scope
        scope.votePoll = (poll)-> ctrl.votePoll poll, scope
        scope.removeDiscussion = -> ctrl.removeDiscussion scope
        scope.foldDiscussion = -> ctrl.foldDiscussion scope

        $timeout(->
          if scope.$parent.$last
            discussionService.rendered()
        ,100)

        scope.$on 'UPDATE.Praise', (e, data)-> ctrl.setGamification data
]

