<script type="text/javascript">
  function searchWords(id)
  {
      var route = '{{ route('searchWords', ['id' => 'parameter']) }}';
      var newRoute = route.replace('parameter',id);
      console.log(newRoute);

      $.ajax({
            url: newRoute,
            headers: {'X-CSRF-TOKEN':token},
            type: 'GET',
            datatype: 'json',
            success:function(data)
            {
              var words = data.html;
              var emptyDefinition = "";
              $("#Words").html(words);
              $("#definition").html(emptyDefinition);
            },
            error:function(data)
            {
                alert('mal');
            }
        });
  };

  function searchDefinitions(id)
  {

    var route = '{{ route('searchDefinition', ['id' => 'parameter']) }}';
    var newRoute = route.replace('parameter',id);
    console.log(newRoute);

    $.ajax({
          url: newRoute,
          headers: {'X-CSRF-TOKEN':token},
          type: 'GET',
          datatype: 'json',
          success:function(data)
          {
              console.log(data);
              var words = data.html;
              $("#definition").html(words);
          },
          error:function(data)
          {
              alert('mal');
          }
      });
      // var route2 = '{{ route('searchDefinition', ['id' => 'parameter']) }}';
      // var newRoute2 = route2.replace('parameter',id);
      // console.log(newRoute2);
      //
      // $.ajax({
      //       url: newRoute2,
      //       headers: {'X-CSRF-TOKEN':token},
      //       type: 'GET',
      //       datatype: 'json',
      //       success:function(data)
      //       {
      //         console.log(data);
      //         // var definition = data.html;
      //         // $("#definition").html(definition);
      //       },
      //       error:function(data)
      //       {
      //           console.log(data);
      //           alert('mal');
      //       }
      //   });
  };
</script>
