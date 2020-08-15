import React, {Component} from 'react';
import { 
    View, 
    StyleSheet, 
    Text, 
    Modal, 
    WebView,
    TouchableOpacity
} from 'react-native';
import Icon from 'react-native-vector-icons/FontAwesome';

export default class CardSquare extends Component {   

    constructor(props){
        super(props);
    }

    render(){
        return (
            <Modal 
                onRequestClose={this.props.onCancel}
                visible={this.props.isVisible}
                animationType='slide' transparent={true}
            >
                <View style={styles.container}>
                    <View style={{ flex: 1, flexDirection: 'row', justifyContent: 'space-between', paddingTop: 15 }}>
                        <View style={{ flex: 1, paddingLeft: 10 }}>
                            <TouchableOpacity onPress={this.props.onCancel}>
                                <Icon name="close" size={30} color="#800"/>
                            </TouchableOpacity>
                        </View>
                        <View style={{ flex: 1, paddingRight: 5 }}>
                            <Text style={styles.title}>New Card</Text>
                        </View>
                        <View style={{ flex: 1, paddingRight: 5 }}></View>
                    </View>
                    <View style={styles.cardContainer}>
                        <WebView source={{ uri: 'https://kingofblacks.formasites.com.br/cards/validate_webview/12' }}/>
                    </View>
                </View>
            </Modal>
        )
    }
}
const styles = StyleSheet.create({
    container:{
        flex: 1,
        backgroundColor: '#cfe2f3',
    },
    title: {    
        color: 'black',
        fontSize: 25,
    },
    cardContainer: {
       flex: 10,
    },
});