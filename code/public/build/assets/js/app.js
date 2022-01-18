$(function() {
    $('main').on('click', '.btn-toggle .round', function() {
        $(this).toggleClass('active');
        
        // Is not an image
        if ($(this).children('input').val() == 'false') {
            $(this).children('input').val('true');
            $(this).parent().parent().parent().children('.textarea').removeClass('is-active');
            $(this).parent().parent().parent().children('.url').addClass('is-active');
        } else {
            $(this).children('input').val('false');
            $(this).parent().parent().parent().children('.textarea').addClass('is-active');
            $(this).parent().parent().parent().children('.url').removeClass('is-active');
        }
    });

    $('.add-media').click(function(e) {
        e.preventDefault();
        const index = $('.card.grey').length;
        $('button.add-media').before('<div class="card grey"><span class="card-title">Ajout média<i class="bi bi-x-circle remove-media"></i></span><div class="btn-toggle-container"><span>Est-ce une image ?</span><div class="btn-toggle"><div class="round"><input type="hidden" name="trick[trickMedia]['+ index +'][isImg]" value="0"></div></div></div><div class="textarea is-active"><label for="embed">Code embed</label><textarea id="embed" class="white" name="trick[trickMedia]['+ index +'][embed]" placeholder=\'Ex: <iframe width="560" height="315" src="https://www.youtube.com/embed/monyw0mnLZg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>\'></textarea></div><div class="url"><label for="url">URL de l\'image</label><input type="url" id="url" class="white" name="trick[trickMedia]['+ index +'][url]" placeholder="Ex: https://img.redbull.com/images"></div></div>');
    });

    $('main').on('click', '.remove-media', function() {
        $(this).parent().parent().remove();
    });

    $('header .hamburger').on('click', () => {
        $('header ul').toggleClass('active');
        $('header .hamburger').toggleClass('active');
    });

    $('button.show-media').on('click', () => {
        $('.trick-media-list').toggleClass('is-active');
    })
});