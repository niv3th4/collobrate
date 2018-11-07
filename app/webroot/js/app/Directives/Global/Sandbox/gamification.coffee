angular.module 'Pyoopil.Directives'
.directive 'gamification', ['EventEmitter', 'Notify', (EventEmitter, Notify)->

  restrict : 'E',
  templateUrl : '/pyoopil/js/app/partials/sandbox/gamification.html',
  link : (scope, elem, attrs)->

    new class Gamification extends EventEmitter

      constructor : ->

        @$praises = elem.find '.clk-tt'

        @type = attrs.type

        if @type is 'Discussion'
          @data = scope.discussion[@type]
          scope.Gamificationvote = scope.discussion.Gamificationvote
        else
          @data = scope.reply
          scope.Gamificationvote = scope.reply.Gamificationvote

        scope.canPraise = !@data.showGamification
        scope.showPraiseResults = @data.showGamification
        scope.showPraise = false
        scope.handlePraise = @handlePraise

        elem.on 'click', '.addPraise', (e) =>
          scope.showPraise = !scope.showPraise
          if not scope.$$phase
            scope.$digest()

      handlePraise : (praise) =>

        scope.Gamificationvote[praise] += 1
        scope.canPraise = false
        scope.showPraiseResults = true
        scope.showPraise = false

        @broadcast 'UPDATE.Praise', { "praise": praise, "id": @data.id, "type" : @type }, scope


]