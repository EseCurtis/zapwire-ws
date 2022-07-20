const formHandler = (resp) => {
    print.in(resp)

    resp = JSON.parse(resp)
    let respCode = resp.message[0];
    let path = resp.route;

    switch(path) {
        case 'channel/create':
            if (respCode === '11') {
                salert('Channel created successfully', 'success')
                setTimeout(() => {
                    window.location.href = amvcPageData.siteUrl+'/dashboard'
                }, 2000);
            } else {
                switch(respCode) {
                    case '0':
                        salert('Please fill out the form', 'error')
                        break;
                    case '1':
                        salert('Sorry, Server Error encounterd try again.', 'error')
                        break;
                }
            }
            break;
        case 'channel/update':
            if (respCode === '11') {
                salert('Channel updated successfully', 'success')
                setTimeout(() => {
                    window.location.href = amvcPageData.siteUrl+'/dashboard'
                }, 2000);
            } else {
                switch(respCode) {
                    case '0':
                        salert('Please fill out the form', 'error')
                        break;
                    case '1':
                        salert('Sorry, Server Error encounterd try again.', 'error')
                        break;
                }
            }
            break;
        case 'channel/delete':
            if (respCode === '11') {
                salert('Channel deleted successfully', 'success')
                setTimeout(() => {
                    window.location.href = amvcPageData.siteUrl+'/dashboard'
                }, 2000);
            } else {
                switch(respCode) {
                    case '0':
                        salert('Please fill out the form', 'error')
                        break;
                    case '1':
                        salert('Sorry, Server Error encounterd try again.', 'error')
                        break;
                }
            }
            break;
        case 'settings/change_password':
            //create handlers for only responses S001, E001, E002 and E003
            if (respCode === 'S001') {
                salert('Password changed successfully', 'success')
                setTimeout(() => {
                    window.location.href = amvcPageData.siteUrl+'/dashboard'
                }, 2000);
            } else {
                switch(respCode) {
                    case 'E001':
                        //password changew was ineruppted by server error
                        salert('Sorry, Server Error encounterd try again.', 'error')
                        break;
                    case 'E002':
                        //password is too short
                        salert('Password too short', 'error')
                    case 'E003':
                        //password and confirm password do not match
                        salert('Password and confirm password do not match', 'error')
                        break;
                    case 'E004':
                        //last password is incorrect
                        salert('Last password is incorrect', 'error')
                        break;

                }
            }

    }
}


const salert = (message = '{message}', type = 'success') => {
    Swal.fire({
        icon: type,
        title: message,
        showConfirmButton: false,
        timer: 1500
    })
}


function typeText(item, text, delay, i) {
    $(item).append(text.charAt(i))
        .delay(delay)
        .promise()
        .done(function() {
          if(i<text.length) {
            i++;
            typeText(item, text, delay, i);  
          }
    });       
}


//search if there are tables if there are tables then make them sortable
if (document.getElementsByClassName('table').length > 0) {
    var tables = document.getElementsByClassName('table');
    for (var i = 0; i < tables.length; i++) {
        var table = tables[i];
        var options = {
            // options here
        };
        var dataTable = new DataTable(table, options);
    }

    let searchValue = $_GET('q');
    if (searchValue) {
        document.querySelector('div.dataTable-search input').value = searchValue;
    }

    typeText($('div.dataTable-search input'), 'text', 500, 0);

}

//create a darkmode feature using the set_darkmode interactor using AMVC 
const darkmode = () => {
    let new_status = 0
    let fd = new FormData()

    if(darkmode_status == 0) {
        document.body.classList.add('darkmode')
        new_status = 1
        darkmode_status = 1
    } else {
        document.body.classList.remove('darkmode')
        new_status = 0
        darkmode_status = 0
    }

    fd.append('darkmode', 'dm_'+new_status)

    new AMVC().interact((resp) => {
        //print.in(resp)
    }, 'settings/set_darkmode.php', fd)
}

//map function to all darkmode toggler carrying the darkmode-switch class
document.querySelectorAll('.darkmode-switch').forEach(function(el) {
    el.addEventListener('click', function() {
        darkmode()
    })
})

document.getElementsByTagName('body')[0].onload = () => {
    document.getElementsByTagName('body')[0].style.opacity = '1'
}

// const zapwire = new Zapwire('df6bb43e722af390c');
// zapwire.wire(print.in)