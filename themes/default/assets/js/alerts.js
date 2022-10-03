window.notification2 = function(message, type, options) {
    if (Swal === undefined) return false;

    let modal = type || 'alert';
    let default_options = options || {};
    let config = {};
    switch (modal) {
        case 'alert':
        case 'error':
            config = {
                icon: 'error',
                title: message,
                showConfirmButton: true,
                timer: 7500
            };
            break;
        case 'prompt':
            config = {
                title: message,
                input: 'text',
                inputValue: options.inputValue,
                showCancelButton: true,
                showConfirmButton: false,
            };
            break;
        case 'confirm':
            config = {
                text: message,
                icon: 'warning',
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            }
            break;
        default:
            return false;
    }
    config = Object.assign(default_options,config);
    return Swal.fire(config);
}

window.alert2 = function(message, type, options){
    if(!notification2(message,'error')) {
        alert(message);
    }
}

function confirm2(message,options) {
    let res = notification2(message,'error');
    return res || confirm(message);
}

function prompt2(title,val) {
    if(!notification2(title,'error',{inputValue: val})) {
        return prompt(title, val);
    }
}



