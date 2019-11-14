function do_toggle(_this_){
        toggle = _this_.attr('data-toggle');
        if(toggle === void 0){
          toggle = 1;
        }else{
          toggle = parseInt(toggle);
        }
        _this_.attr('data-toggle', (toggle + 1) % 2); 
        return toggle;
      }
      function bind_toggle(){
        $(".toggle-area").bind("click",function(){
          var card = $(this).parents(".card_outer").children(".card");
          var id = card.attr('id').slice("card".length);
          toggle = do_toggle(card);
          var content;
          if(toggle){
            content = $('#back'+id).html();
          }else{
            content = $('#front'+id).html();
          }
          card.flip({
            direction: "rl",
            content: content,
            color: "white",
            onEnd: function(){bind_toggle();}
          });
          return false;
        });
      }
      
      function set_front(){
        $(".card_outer").each(function(){
          card = $(this).children(".card");
          front = $(this).children(".front");
          card.html(front.html());
        });
      }
      $(function(){
        set_front();
        bind_toggle();
      });