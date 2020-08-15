import React, {Component} from 'react';
import { 
    View, 
    StyleSheet, 
    Text, 
    AsyncStorage,
    ImageBackground,
    TouchableOpacity,
    Alert, Modal
} from 'react-native';
import Icon from 'react-native-vector-icons/FontAwesome';
import backgroundImage from '../../assets/imgs/login.jpg';
import AuthInput from '../components/AuthInput';
import axios from 'axios';
import {server, showError} from '../common';
import * as GoogleSignIn from 'expo-google-sign-in';
import * as Facebook from 'expo-facebook';

export default class Auth extends Component {
    state = {
        stageNew: false,
        name: '',
        email: '',
        password: '',
        confirmPassword: '',
        accessCode: '',
        modalVisible: false,
    }       

    doLogin = async () => {
        try {
            const res = await axios.post(`${server}/login`, {                                        
                email: this.state.email,
                access_code: this.state.accessCode,
            })  

            if(res.data.status == 200){                
                axios.defaults.headers.common['Authorization'] = `Bearer ${res.data.user.api_token}`;
                AsyncStorage.setItem('userData', JSON.stringify(res.data.user));
                this.setState({modalVisible: false});
                this.props.navigation.navigate('Main', res.data.user);
            }
        } catch (error) {
            showError('Invalid access code');
        }
    }

    signIn = async () => {
        try {
            const res = await axios.post(`${server}/access`, {                                        
                email: this.state.email,                
            })              
            
            if(res.data.status == 200){                
                this.setState({modalVisible: true});
            }else{
                showError('Invalid credentials!');
            }
            
        } catch (error) {
            showError('This e-mail do not match our records.');
        }
    }

    signUp = async () => {
        try {
            await axios.post(`${server}/register`, {
                name: this.state.name,
                email: this.state.email,
                password: this.state.password,
            })

            if(res.data.status == 200){                
                this.setState({modalVisible: true, stageNew: false});
            }else{
                showError('Invalid credentials!');
            }
        } catch (error) {                
            showError(error);
        }
    }

    _handleFacebookLogin = async () => {
        try {
            const { type, token } = await Facebook.logInWithReadPermissionsAsync(
                '465638704005663',
                { permissions: ['public_profile','email']}
            );

            switch (type) {
                case 'success': {                  
                  const response = await fetch(`https://graph.facebook.com/me?fields=name,email&access_token=${token}`);
                  const profile = await response.json();
                  if(profile){
                    const res = await axios.post(`${server}/access/socials`, {                                        
                        email: profile.email,     
                        name: profile.name,
                    })                      
                    
                    if(res.data.status == 200){                
                        this.setState({modalVisible: true, email: profile.email});
                    }else{
                        showError('Login with facebook failed!.');
                    }
                  }          
                  break;
                }
                case 'cancel': {
                  Alert.alert(
                    'Cancelled!',
                    'Login was cancelled!',
                  );
                  break;
                }
                default: {
                  showError('Login with facebook failed!.');                  
                }
            }
            
        } catch (error) {
            showError('Login with facebook failed!.');  
        }
    };

    _handleGoogleLogin = async () => {
        try {
            await GoogleSignIn.askForPlayServicesAsync();
            const { type, user } = await GoogleSignIn.signInAsync();
            if (type === 'success') {
                const res = await axios.post(`${server}/access/socials`, {                                        
                    email: user.email,     
                    name: user.displayName,
                })                                          
                if(res.data.status == 200){                
                    this.setState({modalVisible: true, email: user.email});
                }else{
                    showError('Login with google failed!.');
                }
            }
        } catch ({ message }) {
            alert('login: Error:' + message);
        }
    }

    signinOrSignup = () => {        
        if (this.state.stageNew){
            this.signUp();
        }else{
            this.signIn();
        }
    }

    googleInicialize = async () => {
        try {
            await GoogleSignIn.initAsync({ clientId: '487681329124-emssru0jm7f8tqa3mmk1gid6ojipo81v.apps.googleusercontent.com' });
        } catch ({ message }) {
            showError(message);
        }
    }

    componentDidMount(){
        this.googleInicialize();
    }

    render(){

        const validations = [];
        const validations_code = [];
        validations.push(this.state.email && this.state.email.includes('@'));
        validations_code.push(this.state.accessCode && this.state.accessCode.length >= 6);
        
        if(this.state.stageNew){
            validations.push(this.state.password && this.state.password.length >= 4);
            validations.push(this.state.name && this.state.name.trim());
            validations.push(this.state.confirmPassword);
            validations.push(this.state.password === this.state.confirmPassword);
        }

        const validForm = validations.reduce((all, v) => all & v);
        const validCode = validations_code.reduce((all, v) => all & v);

        return (
            <ImageBackground 
                source={backgroundImage} 
                style={styles.background}
            >  
                <Modal                  
                  animationType="slide"
                  transparent={false}
                  visible={this.state.modalVisible == true}
                  onRequestClose={() => {}}>                        
                        <View style={styles.modal}>
                            <Text style={styles.subtitle}>                                
                                We send to you e-mail a code. Please set here
                            </Text>                            
                            <AuthInput icon='lock' placeholder="Access Code" style={styles.inputModal}
                                    value={this.state.accessCode}
                                    keyboardType={'numeric'}
                                    onChangeText={accessCode => this.setState({accessCode})}/>
                            <TouchableOpacity 
                                style={{width: '40%'}} 
                                disabled={!validCode} 
                                onPress={this.doLogin}>
                                <Text style={[styles.button,styles.buttonText, !validCode ? { backgroundColor: '#AAA'} : {} ]}>
                                    Sign-In
                                </Text>
                            </TouchableOpacity>
                            <TouchableOpacity
                              onPress={() => {
                                this.setState({modalVisible: false})
                              }}>
                              <Text style={[styles.buttonModalClose,styles.buttonTextModal]}>Go back!</Text>
                            </TouchableOpacity>
                        </View>
                </Modal>
                
                <Text style={styles.title}>King of blacks</Text>
                <View style={styles.formContainer}>
                    <Text style={styles.subtitle}>
                        {this.state.stageNew ?
                            'Create you account': 'Enter with your E-mail'}
                    </Text>
                    {this.state.stageNew &&
                        <AuthInput icon='user' placeholder="Name" style={styles.input}
                            value={this.state.name}
                            onChangeText={name => this.setState({name})}/>}
                    <AuthInput icon='at' placeholder="Email" style={styles.input}
                            value={this.state.email}
                            onChangeText={email => this.setState({email})}/>
                    {this.state.stageNew &&
                    <AuthInput icon='lock' secureTextEntry={true} 
                            placeholder="Password" style={styles.input}
                            value={this.state.password}
                            onChangeText={password => this.setState({password})}/>}
                    {this.state.stageNew &&
                        <AuthInput icon='lock' secureTextEntry={true} 
                            placeholder="Confirmation" style={styles.input}
                            value={this.state.confirmPassword}
                            onChangeText={confirmPassword => this.setState({confirmPassword})}/>}
                    <TouchableOpacity 
                        disabled={!validForm}
                        onPress={this.signinOrSignup}
                    >
                        <Text style={[styles.button,styles.buttonText, !validForm ? { backgroundColor: '#AAA'} : {} ]}>
                            {this.state.stageNew ? 'Register' : 'Sign-In'}
                        </Text>
                    </TouchableOpacity>
                    {!this.state.stageNew &&
                    <View>
                        <TouchableOpacity onPress={this._handleGoogleLogin}>
                            <Text style={[styles.buttonGoogle,styles.buttonText]}>
                                <Icon name='google' size={20}/> Login with Google
                            </Text>
                        </TouchableOpacity>
                        <TouchableOpacity onPress={this._handleFacebookLogin}>
                            <Text style={[styles.buttonFace,styles.buttonText]}>
                                <Icon name='facebook' size={20}/> Login with Facebook
                            </Text>
                        </TouchableOpacity>
                    </View>}
                </View>
                <TouchableOpacity 
                    style={{padding:10}} 
                    onPress={() => this.setState({ stageNew: !this.state.stageNew })}
                >
                    <Text style={styles.buttonText}>
                        {this.state.stageNew ? 'Already have an account?' : 'Do not have an account yet?'}
                    </Text>
                </TouchableOpacity>                
            </ImageBackground>
        )
    }
}

const styles = StyleSheet.create({
    background: {
        flex: 1,
        width: '100%',
        alignItems: 'center',
        justifyContent: 'center',
    },
    title: {
        // fontFamily: commonStyles.fontFamily,
        color: '#FFF',
        fontSize: 50,
        marginBottom: 10,
    },
    subtitle: {        
        // fontFamily: commonStyles.fontFamily,
        color: '#FFF',
        fontSize: 20,
        textAlign: 'center',
    },
    formContainer: {
        backgroundColor: 'rgba(0,0,0,0.8)',
        padding: 20,
        width: '90%',
    },
    input: {
        marginTop: 10,
        backgroundColor: '#FFF',
    },
    button: {
        backgroundColor: '#080',
        marginTop: 10,
        padding: 10,
        alignItems: 'center',
    },
    buttonText: {
        // fontFamily: commonStyles.fontFamily,
        color: '#FFF',
        fontSize: 20,
        textAlign: 'center',
    },
    modal:{
        flex: 1,
        width: '100%',
        alignItems: 'center',
        justifyContent: 'center',
        backgroundColor: 'rgba(0,0,0,0.8)',
        padding: 20,
    },
    inputModal: {
        marginTop: 10,
        backgroundColor: '#FFF',
        width: '70%',
        textAlign: 'center',
    },
    buttonModal: {
        backgroundColor: '#080',
        marginTop: 10,
        padding: 10,
        alignItems: 'center',
        width: '40%',
    },
    buttonTextModal: {        
        color: '#FFF',
        fontSize: 20,
        width: '40%',
        textAlign: 'center',
    },
    buttonModalClose: {
        backgroundColor: 'transparent',
        marginTop: 10,
        padding: 10,
        alignItems: 'center',
        width: '40%',
    },
    buttonFace: {
        backgroundColor: '#4267b2',
        marginTop: 10,
        padding: 10,
        alignItems: 'center',
    },
    buttonGoogle: {
        backgroundColor: '#db483b',
        marginTop: 10,
        padding: 10,
        alignItems: 'center',
    },
})