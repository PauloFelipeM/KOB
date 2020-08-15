import React, {Component} from 'react';
import { 
    View, StyleSheet, Text, FlatList, Platform, Alert
} from 'react-native';
import ActionButton from 'react-native-action-button';
import axios from 'axios';
import {server, showError} from '../common';
import Cards from '../components/Cards';
import CardSquare from './CardSquare'
import AddCard from './AddCard';

export default class Card extends Component {

    state = {
        cards: [],
        showAddCard: false,
    }

    loadCards = async () => {        
        try {       
             const res = await axios.get(`${server}/cards`);
             this.setState({ cards: res.data.data});
        } catch (error) {
            showError(error);
        }
    }

     componentDidMount = async () =>{
        await this.loadCards();
    }

    addCard = async card => {
        try {
            const res = await axios.post(`${server}/cards/create`, {
                state_id: card.state_id,
                country_id: card.country_id,
                number: card.number,
                name: card.name,
                card_address: card.card_address,
                card_address_postal_code: card.card_address_postal_code,
                card_address_city: card.card_address_city,
                code: card.code,
                expiration: card.expiration,
            })

            if(res.data.status == 200){          
                this.setState({ showAddCard: false }, this.loadCards);
                Alert.alert('Success!', res.data.message);
            }
        } catch (error) {
            Alert.alert('Ops!. Something is wrong.', 'Please check the informations and try again.');
        }
    }

    deleteCard = async id => {
        try {
            Alert.alert(
                'Delete',
                'Do you really want to delete this record?',
                [              
                  {
                    text: 'Cancel',
                    style: 'cancel',
                  },
                  {text: 'OK', onPress: async () => {
                    const res = await axios.post(`${server}/cards/delete/${id}`);            
                    if(res.data.status == 200){
                        this.loadCards();
                        Alert.alert('Success!', res.data.message);
                    }
                  }},
                ],
                {cancelable: false},
            );
        } catch (error) {
            showError(error);
        }
    }

    render(){
        return (
            <View style={styles.container}>
                {/* {this.state.showAddCard && <AddCard 
                    isVisible={this.state.showAddCard}
                    onSave={this.addCard}
                    onCancel={() => this.setState({ showAddCard: false })}
                />} */}
                {this.state.showAddCard && <CardSquare 
                    isVisible={this.state.showAddCard}
                    onCancel={() => this.setState({ showAddCard: false })}
                />}
                 <View style={styles.iconBar}>
                    <Text style={styles.title}>{this.props.title}</Text>
                </View>
                <View style={styles.cardContainer}>
                    <FlatList 
                        data={this.state.cards}
                        keyExtractor={item => `${item.id}`}
                        renderItem={({item}) => <Cards {...item}
                                                    onDelete={this.deleteCard}                                                    
                                                />}
                    />
                </View>
                <ActionButton buttonColor='#080'
                    onPress={() => {this.setState({ showAddCard: true })}}/>
            </View>
        );
    }
}

const styles = StyleSheet.create({
    container:{
        flex: 1,
        backgroundColor: '#cfe2f3',
        width: '100%',
    },
    title: {    
        color: 'black',
        fontSize: 30,
        textAlign: 'center',
    },
    cardContainer: {
       flex: 7,
    },
    iconBar: {
        marginTop: Platform.OS === 'ios' ? 30 : 20,
        marginHorizontal: 20,
        alignItems: 'center'
    }
});