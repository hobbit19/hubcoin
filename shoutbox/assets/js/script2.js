$(function(){

    // Storing some elements in variables for a cleaner code base

    var refreshButton = $('#reftb'),
        shoutboxForm = $('.shoutbox-form'),
        form = shoutboxForm.find('form'),
        closeForm = shoutboxForm.find('h2 span'),
        nameElement = form.find('#shoutbox-name'),
        commentElement = form.find('#shoutbox-comment'),
        ul = $('ul.shoutbox-content');


    // Replace :) with emoji icons:
    emojione.ascii = true;

    // Load the comments.
    load();
    
    // On form submit, if everything is filled in, publish the shout to the database
    
    var canPostComment = true;

    form.submit(function(e){
        e.preventDefault();

        if(!canPostComment) return;
        
        var name = nameElement.val().trim();
        var comment = commentElement.val().trim();

        if(name.length < 20 && name.length > 0) {
            if(comment.length < 290 && comment.length > 1){
        
            publish(name, comment);

            // Prevent new shouts from being published

            canPostComment = false;

            // Allow a new comment to be posted after 5 seconds

            setTimeout(function(){
                canPostComment = true;
            }, 5000);
             $('.shoutbox-comment-label').text('Message');
            }
            else{
                $('.shoutbox-comment-label').text('Message is too long(>290 symbols) or short');
            }
        }

    });
    
    // Toggle the visibility of the form.
    
    shoutboxForm.on('click', 'h2', function(e){
        $('#reft').toggleClass('activeHubb')

        if(form.is(':visible')) {
           closecss();

            $('#shoth').text('Write a message');
            $('#reft').text('Hubbox');
            formClose();

        }





        else {
            
            opencss();

            $('#shoth').text('Close');
            $('#reft').text('Refresh');
            formOpen();
        }
        
    });

    function closecss(){
         $('.shoutbox').css({"max-height":"800px",
                                "max-width":"225px",
                                "margin": '0 auto',
                                'overflow': 'hidden',
                                'z-index': '10',  
                                'position': 'fixed',
                                'bottom': '1em',
                                'left': '5%',
                                'background-color': '#f9fafb',
                                'border-radius': '9px' })

            $('.shoutbox-content').css({
                    'list-style': 'none',
                    'width': '100%',
                    'max-width': '400px',
                    'max-height': '200px',
                    'margin':'0',
                    'padding':'0',
                    'color': '#df377a',
                    'font-size': '11px',
                    'font-weight': '700',
                    'text-align': 'left',
                    'overflow-x': 'auto'
            })
    }
    function opencss(){
        $('.shoutbox').css({"max-height":"800px",
                                "max-width":"400px",
                                "margin": '0 auto',
                                'overflow': 'hidden',
                                'z-index': '10',  
                                'position': 'fixed',
                                'bottom': '1em',
                                'left': '5%',
                                'background-color': '#f9fafb',
                                'border-radius': '9px' });

            $('.shoutbox-content').css({
                    'list-style': 'none',
                    'width': '100%',
                    'max-width': '400px',
                    'max-height': '400px',
                    'margin':'0',
                    'padding':'0',
                    'color': '#df377a',
                    'font-size': '11px',
                    'font-weight': '700',
                    'text-align': 'left',
                    'overflow-x': 'auto'})
    }
    // Clicking on the REPLY button writes the name of the person you want to reply to into the textbox.
    
    ul.on('click', '.replyme', function(e){
        
        var replyName = $(this).data('name');
        opencss();
        formOpen();
        commentElement.val('@'+replyName+' ').focus();

    });
    
    // Clicking the refresh button will force the load function
    
    var canReload = true;

    refreshButton.click(function(){

        if(!canReload) return false;
        
        load();
        canReload = false;

        // Allow additional reloads after 2 seconds
        setTimeout(function(){
            canReload = true;
        }, 2000);
    });

    // Automatically refresh the shouts every 20 seconds
    setInterval(load,5000);


    function formOpen(){
        
        if(form.is(':visible')) return;
        form.slideDown();
        closeForm.fadeIn();
    }

    function formClose(){

        if(!form.is(':visible')) return;

        form.slideUp();
        closeForm.fadeOut();
    }

    // Store the shout in the database
    
    function publish(name,comment){
    
        $.post('../shoutbox/publish.php', {name: name, comment: comment}, function(){
            nameElement.val("");
            commentElement.val("");
            load();
        });

    }
    
    // Fetch the latest shouts
    
    function load(){
        $.getJSON('../shoutbox/load.php', function(data) {
            appendComments(data);
        });
    }
    
    // Render an array of shouts as HTML
    
    function appendComments(data) {

        ul.empty();

        data.forEach(function(d){
            ul.prepend('<li>'+
                '<span class="shoutbox-username replyme" data-name="' + d.name + '">' + d.name + ':</span>'+
                '<p class="shoutbox-comment">' + emojione.toImage(d.text) + '</p>'+
                '<div class="shoutbox-comment-details"><span class="shoutbox-comment-reply" data-name="' + d.name + '"></span>'+
                '<span class="shoutbox-comment-ago">' + d.timeAgo + '</span></div>'+
            '</li>');
        });

    }

});