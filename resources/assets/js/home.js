// openNav();
// openNav("right","#Cartnav");
function openNav(direction,modal){
    $(modal).attr("data-toggle","true");
    $(modal).css(direction,"0");
    $("#content-body").addClass('mobile-header-active');
}
function closeNav(direction,modal){
    $(modal).attr("data-toggle","false");
    $(modal).css(direction,"-300px");
    $("#content-body").removeClass('mobile-header-active');
}

// OPEN/CLOSE CART MODAL
$("#m-open-cart").click(function(ev){
    ev.preventDefault();
    openNav("right","#Cartnav");
});
$("#m-close-cart").click(function(ev){
    ev.preventDefault();
    console.log("shot");
    closeNav("right","#Cartnav");
})

// OPEN/CLOSE NAV MODAL
$("#m-open-nav").click(function(ev){
    ev.preventDefault();
    openNav("left","#Sidenav");
});
$("#m-close-nav").click(function(ev){
    ev.preventDefault();
    closeNav("left","#Sidenav");
})

// MULTI MENU TOGGLE
$("#shop-toggle").click(function(){
    console.log("toggle")
    $("#secondary-menu").slideToggle();
    $(this).toggleClass('navbar-mobile__btn-submenu--active')
})


$("body").click(function(ev){
    if (!$(event.target).closest("#Sidenav").length && !$(event.target).closest("#m-open-nav").length) {
        if($("#Sidenav").attr('data-toggle') == "true"){
            closeNav("left","#Sidenav");
        }
    }
    if (!$(event.target).closest("#Cartnav").length && !$(event.target).closest("#m-open-cart").length) {
        if($("#Cartnav").attr('data-toggle') == "true"){
            closeNav("right","#Cartnav");
        }
    }
});

// BUSQUEDA DE PRODUCTOS
$("#m-open-search").click(function(){
    $("#m-input-search").fadeToggle("fast");
});
