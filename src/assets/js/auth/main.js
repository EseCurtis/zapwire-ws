const salert = (message = '{message}', type = 'success') => {
    Swal.fire({
        icon: type,
        title: message,
        showConfirmButton: false,
        timer: 1500
    })
}

const formHandler = (resp) => {

    resp = JSON.parse(resp)
    let respCode = resp.message[0];
    let path = resp.route;

    switch(path) {
        case 'user/sign-in':
            if (respCode === '11') {
                salert('Login successful, you will be redirected shortly', 'success')
                setTimeout(() => {
                    window.location.href = amvcPageData.siteUrl+'/dashboard'
                }, 2000);
            } else {
                switch(respCode) {
                    case '0':
                        salert('Please fill out the form', 'error')
                        break;
                    case '1':
                        salert('Sorry, Password incorrect.', 'error')
                        break;
                    case 'E001':
                        salert('Sorry, No account associated with this email.', 'error')
                        break;
                    case 'IA':
                        salert('Login successful, you will be redirected shortly', 'success')
                        setTimeout(() => {
                            window.location.href = amvcPageData.siteUrl+'/admin-board'
                        }, 2000);
                        break;
                }
            }
            break;
        case 'user/sign-up':
            if (respCode === '11') {
                salert('Signup successful, now login', 'success')
                setTimeout(() => {
                    location.replace(amvcPageData.siteUrl+'/sign-in')
                }, 2000);
            } else {
                switch(respCode) {
                    case '0':
                        salert('Please, Fill out the form.', 'error')
                        break;
                    case '1':
                        salert('Sorry, Server Error encounterd try again.', 'error')
                        break;
                    case 'E001':
                        salert('Sorry, Account associated with that email already exists.', 'error')
                        break;
                    case 'E002':
                        salert('Password too short', 'error')
                        break;
                    case 'E003':
                        salert('Email is invalid', 'error')
                        break;
                    case 'E004':
                        salert('Passwords do not match', 'error')
                        break;
                }
            }
        break;

        case 'user/password-recovery': 
        if (respCode === '12') {
            salert('Recovery link sent to your email!', 'success')
            setTimeout(() => {
                location.replace(amvcPageData.siteUrl+'/sign-in')
            }, 2000);
        } else {
            switch(respCode) {
                case '0':
                    salert('Please, Fill out the form.', 'error')
                    break;
                case 'E001', '11':
                    salert('Sorry, Server Error try again.', 'error')
                    break;
                case 'E002':
                    salert('Sorry, invalid token.', 'error')
                    break;
                case 'E003':
                    salert('Email is invalid', 'error')
                    break;
            }
        }
        break;

        case 'user/password-reset': 
        if (respCode === '11') {
            salert('Password changed successfully!', 'success')
            setTimeout(() => {
                location.replace(amvcPageData.siteUrl+'/login')
            }, 2000);
        } else {
            switch(respCode) {
                case '0':
                    salert('Please, Fill out the form.', 'error')
                    break;
                case 'E001':
                    salert('Sorry, Server Error try again.', 'error')
                    break;
                case 'E002':
                    salert('Sorry, User associated with this token provided does not exist', 'error')
                case 'E003':
                    salert('Passwords do not match', 'error')
                    break;
                case 'E004':
                    salert('Password to short, Expected to be up to 6 or more', 'error')
                    break;
                case 'E005':
                    salert('Invalid token', 'error')
                    break;
            }
        }
        break;

        case 'user/resend-activation-link':
        if (respCode === '1') {
            salert('Activation link sent to your email!', 'success')
            setTimeout(() => {
                location.replace(amvcPageData.siteUrl+'/dashboard')
            }, 2000);
        } else {
            switch(respCode) {
                case '0':
                    salert('Server Error! please try again', 'error')
                    break;
            }
        }
        break;


    }
}

