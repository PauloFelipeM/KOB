import React from 'react';
import {StyleSheet, Text, View, TouchableOpacity} from 'react-native';

export default Cards = props => {
    
    return (
        <View style={styles.container}>
            <Text style={styles.title}>{props.name}</Text>
            <View style={{flex: 1, flexDirection: 'row', justifyContent: 'space-between'}}>
                <Text style={styles.description}>{props.number}</Text>
                <Text style={styles.description}>Exp: {props.expiration}</Text>
            </View>
            <TouchableOpacity 
                style={styles.btn}
                onPress={() => props.onDelete(props.id)}
            >
                <Text style={styles.btntext}>Remove</Text>
            </TouchableOpacity>
        </View>
    )
}

const styles = StyleSheet.create({
    container: {
        backgroundColor: '#FFF',
        borderWidth: 1,
        borderColor: '#DDD',
        borderRadius: 5,
        padding: 10,
        marginBottom: 20,   
        marginTop: 10,
    },
    title: {
        color: '#333',
        fontSize: 18,
        fontWeight: 'bold',        
    },
    description: {
        fontSize: 16,
        color: '#999',
        marginTop: 5,
        lineHeight: 24,
    },
    btn: {
        height: 42,
        borderRadius: 5,
        borderWidth: 2,
        borderColor: '#DA552F',
        backgroundColor: 'transparent',
        justifyContent: 'center',
        alignItems: 'center',
        marginTop: 10,
    },
    btntext: {
        fontSize: 16,
        color: '#DA552F',
        fontWeight: 'bold',
    }

})