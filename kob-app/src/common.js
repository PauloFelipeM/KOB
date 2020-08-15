import {Alert, Platform} from 'react-native';

const server = 'http://kingofblacks.formasites.com.br/api';

function showError(err){
    Alert.alert('Ops!. Something is wrong.', `Message: ${err}`)
}

export {server, showError};