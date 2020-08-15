import React, {Component} from 'react';
import { 
    View, 
    StyleSheet, 
    Text, 
    Modal, 
    TextInput,
    TouchableWithoutFeedback,
    ScrollView,
    TouchableOpacity,
    Picker,
} from 'react-native';
import commonStyles from '../commonStyles';
import axios from 'axios';
import {server} from '../common';

export default class AddCard extends Component {   

    constructor(props){
        super(props);
        this.state = {
            states: [],
            countries: [],
            ...this.getInicitalState()
        };
    }

    getInicitalState = () => {
        return ({
            state_id: '',
            country_id: '',
            number: '',
            name: '',
            card_address: '',
            card_address_postal_code: '',
            card_address_city: '',
            code: '',
            expiration: '',
        })
    }

    save = () => {        
        const data = {...this.state};        
        this.props.onSave(data);
    }

    componentWillMount = () => {
        this.loadStates();   
        this.loadCountries();    
    }

    loadStates = async () => {
        const res = await axios.get(`${server}/states`);
        this.setState({ states: res.data.data});
    }

    loadCountries = async () => {
        const res = await axios.get(`${server}/countries`);
        this.setState({ countries: res.data.data});
    }

    render(){
        let states = this.state.states.map( (item, i) => {
            return <Picker.Item style={styles.input} key={i} value={item.id} label={item.state} />
        });
        let countries = this.state.countries.map( (item, i) => {
            return <Picker.Item style={styles.input} key={i} value={item.id} label={item.country} />
        });
        return (
            <Modal 
                onRequestClose={this.props.onCancel}
                visible={this.props.isVisible}
                animationType='slide' transparent={true}
                onShow={() => this.setState({ ...this.getInicitalState() })}
            >
                <TouchableWithoutFeedback onPress={this.props.onCancel}>
                    <View style={styles.offset}></View>
                </TouchableWithoutFeedback>
                <ScrollView>
                <View style={styles.container}>
                    <Text style={styles.header}>New Card</Text>                    
                    <TextInput
                        placeholder="Number" style={styles.input}
                        keyboardType={'numeric'} 
                        onChangeText={number => this.setState({ number })}
                        value={this.state.number}
                    />
                    <TextInput
                        placeholder="Name" style={styles.input}
                        onChangeText={name => this.setState({ name })}
                        value={this.state.name}
                    /> 
                     <TextInput
                        placeholder="Code" style={styles.input}
                        keyboardType={'numeric'} 
                        onChangeText={code => this.setState({ code })}
                        value={this.state.code}
                    />  
                     <TextInput
                        placeholder="Expiration" style={styles.input}
                        onChangeText={expiration => this.setState({ expiration })}
                        value={this.state.expiration}
                    />
                    <Picker
                      selectedValue={this.state.country_id}
                      style={styles.input}
                      onValueChange={(item) =>
                        this.setState({country_id: item})
                      }>
                        {countries}
                    </Picker>
                    <Picker
                      selectedValue={this.state.state_id}
                      style={styles.input}
                      onValueChange={(item) =>
                        this.setState({state_id: item})
                      }>
                        {states}
                    </Picker>                    
                    <TextInput
                        placeholder="Address" style={styles.input}
                        onChangeText={card_address => this.setState({ card_address })}
                        value={this.state.card_address}
                    />   
                     <TextInput
                        placeholder="Postal code" style={styles.input}
                        keyboardType={'numeric'} 
                        onChangeText={card_address_postal_code => this.setState({ card_address_postal_code })}
                        value={this.state.card_address_postal_code}
                    />  
                    <TextInput
                        placeholder="City" style={styles.input}
                        onChangeText={card_address_city => this.setState({ card_address_city })}
                        value={this.state.card_address_city}
                    />                                      
                    
                    <View style={{flexDirection: 'row', justifyContent: 'flex-end'}}>
                        <TouchableOpacity onPress={this.props.onCancel}>
                            <Text style={styles.button}>Cancelar</Text>
                        </TouchableOpacity>
                        <TouchableOpacity onPress={this.save}>
                            <Text style={styles.button}>Salvar</Text>
                        </TouchableOpacity>
                    </View>
                </View>  
                </ScrollView>            
                <TouchableWithoutFeedback onPress={this.props.onCancel}>
                    <View style={styles.offset}></View>
                </TouchableWithoutFeedback>
            </Modal>
        )
    }
}

const styles = StyleSheet.create({
    container: {
        backgroundColor: '#cfe2f3',
        justifyContent: 'space-between',
    },
    offset: {
        flex: 1,
        backgroundColor: 'rgba(0,0,0,0.7)',
    },
    button: {
        margin: 20,
        marginRight: 30,
        color: commonStyles.colors.default,
    },
    header: {
        backgroundColor: commonStyles.colors.default,
        color: commonStyles.colors.secondary,
        textAlign: 'center',
        padding: 15,
        fontSize: 15,
    },
    input: {
        width: '90%',
        height: 40,
        marginTop: 10,
        marginLeft: 15,
        paddingLeft: 10,
        backgroundColor: 'white',
        borderWidth: 1,
        borderColor: '#e3e3e3',        
    },
})