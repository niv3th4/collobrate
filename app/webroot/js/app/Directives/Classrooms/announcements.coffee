angular.module 'Pyoopil.Directives'
.directive 'announcements', ['EventEmitter', 'Notify', (EventEmitter, Notify)->

  restrict : 'E',
  templateUrl : '/pyoopil/js/app/partials/Classrooms/announcement.html',
  link : (scope, elem, attrs)->

    new class Classrooms

      constructor : ->

        scope.announcements = []

        @addListeners()

      addListeners : ->

        scope.$on 'READ.Announcements', (evt, data) => @renderAnnouncements evt, data


      renderAnnouncements : (evt, announcements) ->

        if _.isEmpty(announcements)
          Notify.alert 'No More Announcements to load', 'error'
          return

        angular.forEach(announcements, (announcement)->
          scope.announcements.push announcement
        )

]