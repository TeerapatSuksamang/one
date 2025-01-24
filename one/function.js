function showpass(){
    document.querySelectorAll('#pass, #pass1').forEach(pass => pass.type = pass.type === 'password' ? 'text' : 'password');
}

img_upload.onchange = function(e){
    const file = e.target.files[0];
    if(file){
        preview.src = URL.createObjectURL(file);
    }
}

function close_qr(){
    var qr = document.getElementById('qr_code');
    document.getElementById('slip').required = false;
    qr.classList.remove('show');

    var toggle = new bootstrap.Collapse(qr, {
        toggle: false
    });
}

function open_qr(){
    document.getElementById('slip').required = true;
}

function form_change(){
    document.getElementsByName('submit')[0].disabled = false;
}