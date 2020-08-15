import React, {Component} from 'react';
import { 
    View, StyleSheet, Text, FlatList, Platform
} from 'react-native';
import axios from 'axios';
import {server, showError} from '../common';
import Tickets from '../components/Tickets';

export default class Bookings extends Component {

    state = {
        tickets: [],
    }

    loadTickets = async () => {        
        try {       
             const res = await axios.get(`${server}/tickets`);
             this.setState({ tickets: res.data.data});
        } catch (error) {
            showError(error);
        }
    }

     componentDidMount = () =>{
        this.loadTickets();
    }

    render(){
        return (
            <View style={styles.container}>
                 <View style={styles.iconBar}>
                    <Text style={styles.title}>{this.props.title}</Text>
                </View>
                <View style={styles.ticketContainer}>
                    <FlatList 
                        data={this.state.tickets}
                        keyExtractor={item => `${item.id}`}
                        renderItem={({item}) => <Tickets {...item}
                                                    onDetails={this.detailTicket}                                                    
                                                />}
                    />
                </View>
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
    ticketContainer: {
       flex: 7,
    },
    iconBar: {
        marginTop: Platform.OS === 'ios' ? 30 : 20,
        marginHorizontal: 20,
        alignItems: 'center'
    }
});