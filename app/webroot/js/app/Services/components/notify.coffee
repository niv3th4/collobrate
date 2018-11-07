angular.module 'Pyoopil.Services'
  .factory 'Notify', [()->

    new class Notify

      constructor : ->


      alert : (message, type) ->
        toastr.clear()
        toastr[type](message)


  ]