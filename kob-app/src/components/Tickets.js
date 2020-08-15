import React from 'react';
import {StyleSheet, Text, View, TouchableOpacity} from 'react-native';
import Icon from 'react-native-vector-icons/FontAwesome';

getStatus = (status) => {
    if(!status){
        return (
            <Text style={styles.description}>Not Started</Text>
        )
    }else if(status == 'Started'){
        return (
            <Text style={styles.description}>Started</Text>
        )
    }else{
        return (
            <Text style={styles.description}>Finished / {status}</Text>
        )
    }
}

export default Tickets = props => {
    return (
        <View style={styles.container}>
            <View style={{flex: 1, flexDirection: 'row', justifyContent: 'space-between'}}>
                <Text style={styles.title}>#{props.id}</Text>
                <Text style={styles.title}>{props.service_type == '1' ? 'Point to Point':'Hourly'}</Text>
            </View>
            <View style={{flex: 1, flexDirection: 'row', justifyContent: 'space-between'}}>
                <Text style={styles.description}>Schedule: {props.scheduled_date}</Text>
                {this.getStatus(props.status)}
            </View>
            <View style={{flex: 1}}>
                <View>
                    <Text style={styles.points}>
                        <Icon name='map-marker' size={11} style={styles.icon}/> {props.origin_address}
                    </Text>
                </View>
                <View>
                    <Text style={styles.points}>
                        <Icon name='map-marker' size={11} style={styles.icon}/> {props.destination_address}
                    </Text>
                </View>
                {props.service_type == '2' && props.number_hours &&
                    <View>
                        <Text style={styles.description}>
                            <Icon name='clock-o' size={11} style={styles.icon}/> {props.number_hours}
                        </Text>
                    </View>
                }
            </View>
            <View style={{flex: 1, flexDirection: 'row', justifyContent: 'space-between'}}>                
                {props.car_id &&
                    <Text style={styles.description}>Car: {props.car.title}</Text>
                }              
                {props.driver_id &&
                    <Text style={styles.description}>Driver: {props.driver.title}</Text>
                }              
            </View>
            <View style={{flex: 1, flexDirection: 'row', justifyContent: 'space-between'}}>                
                <View>
                    <Text style={styles.description}>Amount: {props.amount}</Text>
                </View>                
            </View>
            {/* <TouchableOpacity 
                style={styles.btn}
                onPress={() => props.onDelete(props.id)}
            >
                <Text style={styles.btntext}>Remove</Text>
            </TouchableOpacity> */}
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
        fontSize: 14,
        fontWeight: 'bold',        
    },
    points: {
        fontSize: 11,
        color: '#999',
        lineHeight: 24,
    },
    description: {
        fontSize: 13,
        color: '#999',
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
        fontSize: 14,
        color: '#DA552F',
        fontWeight: 'bold',
    },
    icon: {
        color: '#999',
    },

})