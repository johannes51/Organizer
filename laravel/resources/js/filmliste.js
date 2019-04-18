window.onload = function()
{
  $('form[name = "filmform"]').submit(function(ev) {
    ev.preventDefault();
    $.post('/filmlisteAj/show',
           $( 'form' ).serialize(),
           function (result)
           {
             $('div[name="table"]').empty();
             $('div[name="table"]').append(result.toString());
           });
  })
}

function sortby(sort_param) {
  $form = $('form[name = "filmform"]');
  $form.attr('action', '/filmliste/' + sort_param);
  $form.off('submit');
  $form.submit();
}

function checkUncheck(id, sort_param)
{
  $.ajax({url:'/filmlisteAj/check',
         data:'id=' + id + '&' + 'sort_param=' + sort_param + '&' + $( 'form' ).serialize(),
         method:'POST',
         success:function(result)
         {
           $('div[name="table"]').empty();
           $('div[name="table"]').append(result.toString());
         }
        });
}
