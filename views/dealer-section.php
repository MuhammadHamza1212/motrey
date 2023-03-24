<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
<style>
h2{
  text-align:center;
  padding: 20px;
}
/* Slider */

.slick-slide {
    margin: 0px 20px;
}

.slick-slide img {
    width: 100%;
}

.slick-slider
{
    position: relative;
    display: block;
    box-sizing: border-box;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
            user-select: none;
    -webkit-touch-callout: none;
    -khtml-user-select: none;
    -ms-touch-action: pan-y;
        touch-action: pan-y;
    -webkit-tap-highlight-color: transparent;
}

.slick-list
{
    position: relative;
    display: block;
    overflow: hidden;
    margin: 0;
    padding: 0;
}
.slick-list:focus
{
    outline: none;
}
.slick-list.dragging
{
    cursor: pointer;
    cursor: hand;
}

.slick-slider .slick-track,
.slick-slider .slick-list
{
    -webkit-transform: translate3d(0, 0, 0);
       -moz-transform: translate3d(0, 0, 0);
        -ms-transform: translate3d(0, 0, 0);
         -o-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
}

.slick-track
{
    position: relative;
    top: 0;
    left: 0;
    display: block;
}
.slick-track:before,
.slick-track:after
{
    display: table;
    content: '';
}
.slick-track:after
{
    clear: both;
}
.slick-loading .slick-track
{
    visibility: hidden;
}

.slick-slide
{
    display: none;
    float: left;
    height: 100%;
    min-height: 1px;
}
[dir='rtl'] .slick-slide
{
    float: right;
}
.slick-slide img
{
    display: block;
}
.slick-slide.slick-loading img
{
    display: none;
}
.slick-slide.dragging img
{
    pointer-events: none;
}
.slick-initialized .slick-slide
{
    display: block;
}
.slick-loading .slick-slide
{
    visibility: hidden;
}
.slick-vertical .slick-slide
{
    display: block;
    height: auto;
    border: 1px solid transparent;
}
.slick-arrow.slick-hidden {
    display: none;
}
</style>
<div class="container mt-5 mb-4 pt-4 pb-3 section-container">
	<div class="heading section-heading w-100 bg-transparent">
		<div class="bg-white px-sm-2 me-sm-2 d-inline-block section-heading-text" style="width:fit-content;"><?php echo $labels[$currentLanguageIsoCode]['Our_Dealers']; ?></div>
		<?php 
		echo '<div class="mx-sm-4 bg-white '.($currentLanguageDirection === "rtl" ? "float-start" : "float-end").'">
			<a href="" class="btn btn-outline-danger">'.$labels[$currentLanguageIsoCode]['View_All'].'</a>
		</div>';
		?>
	</div>
	
	<section class="customer-logos slider mt-4" style="direction: ltr;">
    <div class="slide"><img src="./resources/images/custom.png"></div>
    <div class="slide"><img src="./resources/images/blue.png"></div>
    <div class="slide"><img src="./resources/images/brand.png"></div>
    <div class="slide"><img src="./resources/images/blue.png"></div>
    <div class="slide"><img src="./resources/images/custom.png"></div>
    <div class="slide"><img src="./resources/images/blue.png"></div>
    <div class="slide"><img src="./resources/images/custom.png"></div>
    <div class="slide"><img src="./resources/images/blue.png"></div>

	</section>
</div>

<script>
$(document).ready(function(){
    $('.customer-logos').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 4
            }
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 3
            }
        }]
    });
});
</script>