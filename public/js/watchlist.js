function sortby(sort_param) {
  $form = $('form');
  $form.attr('action', '/watchlist/list/' + sort_param);
  $form.off('submit');
  $form.submit();
}

function deleteId(id, sort_param) {
  $.ajax({url:'/watchlistAj/delete/' + sort_param,
         data:'id=' + id + "&" + $( 'form' ).serialize(),
         method:'POST',
         success:function(result)
         {
           $('#table').empty();
           $('#table').append(result.toString());
         },
         error:function(q,s,e)
         {
           $('#table').empty();
           $('#table').append(q.responseText);
          }
        });
}

window.onload = function()
{
  $('form').submit(function(ev) {
    ev.preventDefault();
    $.ajax({url: '/watchlistAj/list',
         data: $( 'form' ).serialize(),
         method: 'POST',
         success: function(result)
         {
           $('#table').empty();
           $('#table').append(result.toString());
         },
         error:function(q,s,e){$('#table').empty();
         $('#table').append(q.responseText);
        }
      });
  })
}
