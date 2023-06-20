function setFavorite($el) {
    var favorites = loadFavorites();

    var id = $el.data('unique-id');
    var adding = !$el.hasClass('track-favorite');
    var index = favorites.indexOf(id);

    if(index === -1 && adding) {
        favorites.push(id);
        $el.addClass('track-favorite');
    }
    else if(index !== -1 && !adding) {
        favorites.splice(index, 1);
        $el.removeClass('track-favorite');
    }

    saveFavorites(favorites);
    setMarkedCounts($el.data('series-id'));
}

function markFavorites() {
    var favorites = loadFavorites();
    if(!favorites.length) return;

    $.each(favorites, function(i) {
        $('.track-container[data-unique-id="'+favorites[i]+'"]').addClass('track-favorite');
    });
}

function removeFromFavoritesByValue(val) {
    var favorites = loadFavorites();
    var index = favorites.indexOf(val);

    if(index !== -1) {
        favorites.splice(index, 1);
        saveFavorites(favorites);
    }
}

function showDashboardFavorites() {
    var favorites = loadFavorites();
    if(!favorites.length) {
        $('#nothing-here').show();
        $('#content-container').hide();
        return;
    }

    $.each(favorites, function(i) {
        var $el = $('.track-container[data-unique-id="'+favorites[i]+'"]');
        if(!$el.length) {
            removeFromFavoritesByValue(favorites[i]);
            return;
        }
        $el.addClass('track-picked').removeClass('track-past-week');
    });
    $('.calendar-logos[data-series-id]').each(function() {
        var id = $(this).data('series-id');
        if($('.track-container.track-picked[data-series-id="'+id+'"]').length) {
            $(this).show();
            $('.calendar-series[data-series-id="'+id+'"]').show();
        }
        $('.active-week[data-series-id="'+id+'"]:last').nextAll().remove();
    });
}

var ownedTracksData = {
    owned: {
        btnClass: 'btn-warning',
        bgClass: 'bg-secondary',
        boxClass: 'track-ownership-green',
        btnText: 'Mark not owned',
        btnIcon: '&#xE03A;'
    },
    notOwned: {
        btnClass: 'btn-success',
        bgClass: 'bg-warning',
        boxClass: 'track-ownership-red',
        btnText: 'Mark owned',
        btnIcon: '&#xE030;'
    }
};

function markOwnedTracks() {
    var owned = loadOwnedTracks();

    $.each(owned, function(i) {
        setTrackOwnershipButtons(owned[i], true);
    });
}

// horribleness
function setTrackOwnershipButtons(id, owned) {
    var $el = $('.track-ownership-btn[data-track-id="'+id+'"]');
    var $linkEl = $('.track-buy[data-track-id="'+id+'"]');
    var $boxEl = $('.track-ownership[data-track-id="'+id+'"]');
    $el.removeClass(ownedTracksData.owned.btnClass).removeClass(ownedTracksData.notOwned.btnClass);
    $linkEl.removeClass(ownedTracksData.owned.bgClass).removeClass(ownedTracksData.notOwned.bgClass);
    $boxEl.removeClass(ownedTracksData.owned.boxClass).removeClass(ownedTracksData.notOwned.boxClass);
    if(owned) {
        $el.addClass(ownedTracksData.owned.btnClass).html(ownedTracksData.owned.btnText);
        $linkEl.addClass(ownedTracksData.owned.bgClass).find('.track-buy-link').html(ownedTracksData.owned.btnIcon);
        $boxEl.addClass(ownedTracksData.owned.boxClass);
    }
    else {
        $el.addClass(ownedTracksData.notOwned.btnClass).html(ownedTracksData.notOwned.btnText);
        $linkEl.addClass(ownedTracksData.notOwned.bgClass).find('.track-buy-link').html(ownedTracksData.notOwned.btnIcon);
        $boxEl.addClass(ownedTracksData.notOwned.boxClass);
    }
}

function setTrackOwnershipState($el) {
    var owned = loadOwnedTracks();
    var id = $el.data('track-id');
    var adding = $el.hasClass(ownedTracksData.notOwned.btnClass);
    var index = owned.indexOf(id);

    if(index === -1 && adding) {
        owned.push(id);
    }
    else if(index !== -1 && !adding) {
        owned.splice(index, 1);
    }

    setTrackOwnershipButtons(id, adding);
    saveOwnedTracks(owned);
}

function loadFavorites() {
    return loadData('myracing-favorites');
}

function saveFavorites(data) {
    return saveData('myracing-favorites', data)
}

function loadOwnedTracks() {
    return loadData('myracing-owned-tracks');
}

function saveOwnedTracks(data) {
    return saveData('myracing-owned-tracks', data);
}

function loadData(key) {
    var data = localStorage.getItem(key);
    data = JSON.parse(data);
    if(!data) data = [];
    return data;
}

function saveData(key, data) {
    localStorage.setItem(key, JSON.stringify(data));
}

function setMarkedCounts(id = 0) {
    var $selector;
    if(id) $selector = $('.planner-favorite-message[data-series-id="'+id+'"]');
    else $selector = $('.planner-favorite-message[data-series-id]');

    $selector.each(function() {
        var id = $(this).data('series-id');
        var count = $('.track-favorite[data-series-id="'+id+'"]').length;
        if(count) $(this).show().find('.planner-favorite-count').html(count);
        else $(this).hide();
    });
}

function initTrackBuyLinks() {
    $('.track-buy-link').each(function() {
        $(this).unbind('click').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('unique-id');
            var $frontEl = $('.track-front[data-unique-id="'+id+'"]');
            var $backEl = $('.track-back[data-unique-id="'+id+'"]');
            var front = $frontEl.is(":visible");

            if(front) {
                $frontEl.data('original-opacity', $frontEl.css('opacity'));
                $frontEl.fadeTo(100, 0, function() {
                    $(this).hide();
                    $backEl.fadeTo(100, 1);
                });
            }
        });
    });

    $('.track-back[data-unique-id]').each(function() {
        $(this).unbind('mouseleave').on('mouseleave', function() {
            var id = $(this).data('unique-id');
            var $frontEl = $('.track-front[data-unique-id="'+id+'"]');
            var $backEl = $('.track-back[data-unique-id="'+id+'"]');
            $backEl.fadeTo(100, 0, function() {
                $(this).hide();
                $frontEl.fadeTo(100, $frontEl.data('original-opacity'));
            });
        });
    });

    $('.track-ownership-btn[data-track-id]').each(function() {
        $(this).unbind('click').on('click', function(e) {
            e.preventDefault();
            setTrackOwnershipState($(this));
        });
    });
}

function initFavorites() {
    $(".planner-calendar-container .track-front[data-unique-id]:not(.track-past-week)").unbind('click').on("click", function(e){
        if(e.target.nodeName == "A") return;
        setFavorite($(this));
    });
}

function initTooltips() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
}

$(function() {
    initTrackBuyLinks();
    markOwnedTracks();
    initFavorites();
    initTooltips();

    $('#loader').fadeTo(400, 0, function() {
        $(this).remove();
    });
});
