import { io } from "https://cdn.socket.io/4.4.1/socket.io.esm.min.js";

class Zapwire {

    api_endpoint            = CDN.api_endpoint
    zapwire_socket_server   = CDN.zapwire_socket_server
    session_token = ''
    ch_key = ''
    tries = 4

    gen_api_endpoint (data, api_key) {
        data._amvc_request_ = JSON.stringify({"command":"_interaction","data_1":`${api_key}`})
        data = JSON.parse(JSON.stringify(data));
        let getParams = ''

        for (var key in data) {
            if (getParams != "") {
                getParams += "&";
            }
            getParams += key + "=" + encodeURIComponent(data[key])
        }

        return `${this.api_endpoint}?${getParams}`
    }

    async wire (onUpdate = ()=>{}, ch_key, config) {
        if (!ch_key) return console.error('No channel key specified')
        if (typeof onUpdate !== 'function') return console.error('No update callback specified')
        if (typeof config !== 'object') return console.error('No config specified')

        let socket = io(this.zapwire_socket_server)

        socket.on('connect', ()=>{
            if(config) socket.emit('set_config', JSON.stringify(config))

            socket.emit('create_session', ch_key)
            socket.on('session_created', session_token => {
                //console.log(session_token)
                socket.emit('wire', session_token)
            })
            socket.on('channel_data', resp =>{
                onUpdate(resp)
            })
            socket.on('error', resp =>{
                console.error(resp)
            })

            socket.on('task', task =>{
                switch (task) {
                    case 'rewire':
                        console.log('Error wiring your zapwire socket')
                        console.info('rewiring in 10 seconds')
                        setTimeout(() => {
                            if(this.tries < 4){
                                this.wire(ch_key, onUpdate)
                                this.tries--
                            }else {
                                console.log('Exceeded number of tries to reconnect try restarting your code')
                            }
                        }, 10000);
                        break;
                
                    default:
                        break;
                }
            })
        })

    }
}

export { Zapwire }