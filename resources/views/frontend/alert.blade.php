<div id="app">


<script src="{{ asset('panel/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('panel/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('panel/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.2.0/socket.io.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
<style>
body {
    background-color: transparent;
    padding: 0;
    color: white;
    text-align: center;
    font-family: 'Roboto', sans-serif;
    text-shadow: 2px 0 0 #2c3e50, 0px 0 0 #2c3e50, 0 2px 0 #2c3e50, 0 0px 0 #2c3e50, 2px 2px #2c3e50, 0px 0px 0 #2c3e50, 2px 0px 0 #2c3e50, 0px 2px 0 #2c3e50;
}

.hide {
    display: none;
}
</style>

<div class="container">
<div class="row">
    <div class="col-lg-8 col-lg-offset-2" >


        <div class="animated main" style="text-align:center;" data-id="2773" data-textgooble="Dũng Đẹp Trai" data-soundgoogle="2">
            <div class="animated hide box-donate" style="width: 90%; margin: 10% 0 0 5%;">
                <div style="width: 100%;">
                    <img style="max-height: 160px;" class="img-responsive" src="https://henryfan.me/panel/img/1.gif">
                </div>
                <div style="width: 100%;">
                    <h2 class="option animated pulse"><span style="color:#3ae450;" class="donate cus-donate">...</span> <b>đ&#227; donate</b> <span style="color:#3ae450;" class="donate money-donate">70000<sup>đ</sup></span></h2>
                    <p class="animated zoomIn cus-note" style="font-size: 16px; font-weight: bold;color:#ff6a00;">chơi hay quá</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<script>
var socket = io.connect('https://henryfan.me:8890');
socket.on('message', function (data) {
     data = JSON.parse(data);
    $('.cus-donate').text(data['name']);
    $('.money-donate').html( data['price'] + ' <sup>đ</sup>');
    $('.cus-note').text(data['message']);
    $('.main').attr('data-textgooble', data['message'] || 'chơi hay quá');
    showDonate();

});
</script>
<script src="https://code.responsivevoice.org/responsivevoice.js"></script>
<script>
function showDonate(data) {
    $('.box-donate').removeClass('hide zoomOut').addClass('zoomIn');
    var audio = new Audio('https://henryfan.me/panel/linhxemom.ogg');
    audio.play();
    setTimeout(function () {
        hideDonate();
    }, 9000);
}

function hideDonate() {
    $('.box-donate').removeClass('zoomIn').addClass('zoomOut');
    if ($('.main').attr('data-soundgoogle') === '2'
        && $('.main').attr('data-textgooble') !== '') {

        responsiveVoice.setDefaultVoice("Vietnamese Female");
        responsiveVoice.speak($('.main').attr('data-textgooble'),"Vietnamese Female",{rate: 0.9});
    }
}
</script>
