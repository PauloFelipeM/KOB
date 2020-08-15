import React, {Component} from 'react';
import { 
    View, 
    StyleSheet, 
    ActivityIndicator, 
    AsyncStorage,
} from 'react-native';
import axios from 'axios';

export default class AuthOrApp extends Component {
    componentWillMount = async () => {
        const res = await AsyncStorage.getItem('userData');
        const userData = JSON.parse(res) || {};        
        if(userData.api_token){
            axios.defaults.headers.common['Authorization'] = 
            `Bearer ${userData.api_token}`;
            this.props.navigation.navigate('Main', userData);
        }else{
            this.props.navigation.navigate('Auth');
        }
    }

    render() {
        return (
            <View style={styles.container}>
                <ActivityIndicator size="large"/>
            </View>
        )
    }
}

const styles = StyleSheet.create({
    container: {
        flex: 1,
        justifyContent: 'center',
        alignItems: 'center',
        backgroundColor: 'black',
    }
})