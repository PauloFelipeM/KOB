import React, {Component} from 'react';
import { 
    View, StyleSheet, Text, CheckBox,
    TextInput, Picker, ScrollView, TouchableOpacity, Platform, Dimensions
} from 'react-native';
import DatePicker from 'react-native-datepicker';
import axios from 'axios';
import {server, showError} from '../common';
import MapView from 'react-native-maps';
import MapViewDirections from 'react-native-maps-directions';

const { width, height } = Dimensions.get('window');
const ASPECT_RATIO = width / height;
const LATITUDE = 37.771707;
const LONGITUDE = -122.4053769;
const LATITUDE_DELTA = 0.0922;
const LONGITUDE_DELTA = LATITUDE_DELTA * ASPECT_RATIO;
const GOOGLE_MAPS_APIKEY = 'AIzaSyAabyf32b4Uaij8a_se0udwl2JwkebIAvg';

export default class Main extends Component {

    constructor(props){
        super(props);
        this.state = {
            cards: [],
            carTypes: [],
            predictionsOrigin: [],
            predictionsDestionation: [],
            origin_coordinates: [
              {
                latitude: null,
                longitude: null,
              },
            ],
            destination_coordinates: [
              {
                latitude: null,
                longitude: null,
              },
            ],
            origin_set: false,
            destionation_set: false,     
            ...this.getInicitalState()
        };
        this.mapView = null;
    }
    
    getInicitalState = () => {
        return {
            date: null,
            serviceType: '1',
            differentLocation: false,
            hours: '',
            cartype_id: '',
            card_id: '',
            origin_address: '',
            destination_address: '',
            passengers: '',
            luggage: '',
            childSeat: '',
            checkAddComments: false,
            addComments: '',
            distance: null,
            amount: '',
        }
    }

    onCreate = async () => {               
      if(!this.state.date){
        showError('Please select a date and time');
        return;
      }
      if(this.state.serviceType == 1 && (!this.state.origin_address || !this.state.destination_address)){
        showError('Please inform origin and destionation addresses');
        return;
      }
      if(this.state.serviceType == 2 && !this.state.hours){
        showError('Please inform a quantity for hours');
        return;
      }
      if(this.state.serviceType == 2 && !this.state.origin_address){
        showError('Please inform a origin address');
        return;
      }
      if(!this.state.cartype_id){
        showError('Please select a car');
        return;
      }
      if(!this.state.card_id){
        showError('Please select a card');
        return;
      }
      if(!this.state.amount){
        showError('Please all informations and try again');
        return;
      }
      let origin_coordinates = `${this.state.origin_coordinates[0].latitude},${this.state.origin_coordinates[0].longitude}`;
      let destionation_coordinates = null;
      let number_hours = 0;
      if(this.state.destination_coordinates[0].latitude && this.state.destination_coordinates[0].longitude){
        destionation_coordinates = `${this.state.destination_coordinates[0].latitude},${this.state.destination_coordinates[0].longitude}`;
      }
      if(this.state.hours){
        number_hours = this.state.hours;
      }
      try {
        const res = await axios.post(`${server}/tickets/create?`,{
          service_type: this.state.serviceType,
          card_id: this.state.card_id,
          car_type_id: this.state.cartype_id,
          scheduled_date: this.state.date.toString(),
          origin_address: this.state.origin_address,
          origin_coordinates: origin_coordinates,
          destination_address: this.state.destination_address,
          destionation_coordinates: destionation_coordinates,
          luggage_count: this.state.luggage,
          number_passengers: this.state.passengers,
          number_hours: number_hours,
          child_seat: this.state.childSeat,
          amount: this.state.amount,
          additional_commments: this.state.addComments,
        });
  
        if(res.data.status == 200){          
          alert(res.data.message);
          this.props.navigation.navigate('Bookings');
        }else{
          showError(res.data.message);
        }
      } catch (error) {
        showError(error);
    }
    }

    calculatePrice = async () => {
      if(this.state.cartype_id && ((this.state.hours && this.state.hours !== '0') || this.state.distance)){        
        try {       
          let minutes = null;
          let miles = null;
          if(this.state.hours) minutes = this.state.hours * 60;
          if(this.state.distance) miles = this.state.distance / 1.609344;          
          const res = await axios.get(`${server}/tickets/calculate/price?
                                      service_type=${this.state.serviceType}&car_type_id=${this.state.cartype_id}
                                      &miles=${miles}&minutes=${minutes}`
                                     );          
          this.setState({ amount: res.data.data.toString()});
        } catch (error) {
            showError(error);
        }
      }else{
        this.setState({ amount: ''});
      }
    }

    loadCards = async () => {        
        try {       
             const res = await axios.get(`${server}/cards`);
             this.setState({ cards: res.data.data});
        } catch (error) {
            showError(error);
        }
    }

    loadCarTypes = async () => {        
        try {       
             const res = await axios.get(`${server}/cartypes`);
             this.setState({ carTypes: res.data.data});
        } catch (error) {
            showError(error);
        }
    }

    componentDidMount = () =>{
      this.loadCards();
      this.loadCarTypes();
    }

    onChangeOrigin = async (origin_address) => {
      this.setState({ origin_address })
      const apiUrl = `https://maps.googleapis.com/maps/api/place/autocomplete/json?types=geocode&key=${GOOGLE_MAPS_APIKEY}&input=${origin_address}&location=${LATITUDE},${LONGITUDE}&radius=2000`;
      try {
        const result = await fetch(apiUrl);
        const json = await result.json();        
        this.setState({predictionsOrigin: json.predictions});
      } catch (error) {
        showError(error);
      }
    }

    onChangeDestionation = async (destination_address) => {
      this.setState({ destination_address })
      const apiUrl = `https://maps.googleapis.com/maps/api/place/autocomplete/json?types=geocode&key=${GOOGLE_MAPS_APIKEY}&input=${destination_address}&location=${LATITUDE},${LONGITUDE}&radius=2000`;
      try {
        const result = await fetch(apiUrl);
        const json = await result.json();        
        this.setState({predictionsDestionation: json.predictions});
      } catch (error) {
        showError(error);
      }
    }

    onPressPredictionsOrigin = async (prediction) => {
      const apiUrl = `https://maps.googleapis.com/maps/api/place/details/json?placeid=${prediction.place_id}&key=${GOOGLE_MAPS_APIKEY}`;
      try {
        const result = await fetch(apiUrl);
        const json = await result.json();
        let origin_coordinates = await [
          {
            latitude: json.result.geometry.location.lat,
            longitude: json.result.geometry.location.lng,
          },
        ];        
        this.setState({origin_coordinates, origin_address: prediction.description, predictionsOrigin: [], origin_set: true}, this.onhandleFirstMarker)
        this.calculatePrice();
        setTimeout(() => {
          this.calculatePrice();
        }, 1000);
      } catch (error) {
        showError(error);
      }
    }

    onPressPredictionsDestionation = async (prediction) => {
      const apiUrl = `https://maps.googleapis.com/maps/api/place/details/json?placeid=${prediction.place_id}&key=${GOOGLE_MAPS_APIKEY}`;
      try {
        const result = await fetch(apiUrl);
        const json = await result.json();
        let destination_coordinates = await [
          {
            latitude: json.result.geometry.location.lat,
            longitude: json.result.geometry.location.lng,
          },
        ];        
        this.setState({destination_coordinates, destination_address: prediction.description, predictionsDestionation: [], destination_set: true})
        setTimeout(() => {
          this.calculatePrice();
        }, 1000);
      } catch (error) {
        showError(error);
      }
    }

    onhandleFirstMarker = () => {
      this.mapView.fitToCoordinates(this.state.origin_coordinates, {
        edgePadding: {
          right: (width / 20),
          bottom: (height / 20),
          left: (width / 20),
          top: (height / 20),
        }
      });
    }

    onChangeCarType = (item) => {      
      this.setState({cartype_id: item})

      setTimeout(() => {
        this.calculatePrice();
      }, 100);
    }

    onChangeHours = (hours) => {      
      this.setState({hours: hours})

      setTimeout(() => {
        this.calculatePrice();
      }, 100);
    }

    onChangeType = (itemValue) => {
      if(itemValue == '1'){
        this.setState({hours: ''})  
      }else if(itemValue == '2'){
        this.setState({distance: null})    
      }
      this.setState({serviceType: itemValue})

      setTimeout(() => {
        this.calculatePrice();
      }, 100);
    }    

    render(){        
        let cards = this.state.cards.map( (item, i) => {
            return <Picker.Item style={styles.input} key={i} value={item.id} label={item.number} />
        });

        let carTypes = this.state.carTypes.map( (item, i) => {
            return <Picker.Item style={styles.input} key={i} value={item.id} label={item.title} />
        });

        const predictionsOrigin = this.state.predictionsOrigin.map((prediction, i) => {
          return (
            <TouchableOpacity onPress={() => this.onPressPredictionsOrigin(prediction)} key={i} style={styles.suggestions}>
              <Text>{prediction.description}</Text>
            </TouchableOpacity>
          )
        });

        const predictionsDestionation = this.state.predictionsDestionation.map((prediction, i) => {
          return (
            <TouchableOpacity onPress={() => this.onPressPredictionsDestionation(prediction)} key={i} style={styles.suggestions}>
              <Text>{prediction.description}</Text>
            </TouchableOpacity>
          )
        });

        return (
            <ScrollView>                
                <View style={styles.container}>                    

                    <View style={styles.iconBar}>
                        <Text style={styles.title}>{this.props.title}</Text>
                    </View>                    
                    <Picker
                      selectedValue={this.state.serviceType}
                      style={styles.input}
                      onValueChange={(itemValue) =>
                        this.onChangeType(itemValue)
                      }>
                      <Picker.Item label="Point to Point" value="1" />
                      <Picker.Item label="Hourly" value="2" />
                    </Picker>                    
                    <DatePicker
                      style={styles.date}
                      date={this.state.date}
                      mode="datetime"
                      placeholder="Select a date"
                      minDate={new Date()}
                      format="YYYY-MM-DD h:mm"                            
                      confirmBtnText="Confirm"
                      cancelBtnText="Cancel"
                      customStyles={{
                        dateInput: {                          
                          backgroundColor: 'white',   
                          borderWidth: 0,  
                        }                    
                      }}
                      onDateChange={(date) => {this.setState({date: date})}}
                    />
                    {this.state.serviceType == 2 &&
                        <TextInput
                            placeholder="Hours (Number)"
                            style={styles.input}
                            keyboardType={'numeric'}
                            value={this.state.hours}
                            onChangeText={hours => this.onChangeHours(hours)}
                        />
                    }
                    <TextInput
                        placeholder="Origin address"
                        style={styles.input}
                        value={this.state.origin_address}
                        onChangeText={origin_address => this.onChangeOrigin(origin_address)}
                    />
                    {predictionsOrigin}
                    {this.state.serviceType == 2 && 
                        <View style={{ flexDirection: 'row', marginTop: 10 }}>
                          <CheckBox
                            value={this.state.differentLocation}
                            onValueChange={() => this.setState({ differentLocation: !this.state.differentLocation })}
                          />
                          <Text style={{marginTop: 5}}> Return at differente location</Text>
                        </View>
                    }
                    {this.state.serviceType == 1 &&
                        <TextInput
                            placeholder="Destination address"
                            style={styles.input} 
                            value={this.state.destination_address}                           
                            onChangeText={destination_address => this.onChangeDestionation(destination_address)}
                        />
                    }                    
                    {this.state.serviceType == 2 && this.state.differentLocation == true &&
                        <TextInput
                            placeholder="Destination address"
                            style={styles.input}
                            value={this.state.destination_address}                          
                            onChangeText={destination_address => this.onChangeDestionation(destination_address)}
                        />
                    }
                    {predictionsDestionation}      
                    <MapView
                        style={styles.map}
                        initialRegion={{
                          latitude: LATITUDE,
                          longitude: LONGITUDE,
                          latitudeDelta: LATITUDE_DELTA,
                          longitudeDelta: LONGITUDE_DELTA,
                        }}
                        ref={c => this.mapView = c}
                    >
                        {this.state.origin_set && this.state.origin_coordinates.map((coordinate, index) =>
                          <MapView.Marker 
                            key={`coordinate_${index}`} 
                            image='https://www.google.com/mapfiles/dd-start.png'
                            coordinate={coordinate}
                          />
                        )}                                                
                        {this.state.destination_set && this.state.destination_coordinates.map((coordinate, index) =>
                          <MapView.Marker
                            key={`coordinate_${index}`}
                            coordinate={coordinate}
                            image='https://www.google.com/mapfiles/dd-end.png'
                          />
                        )}
                        {(this.state.origin_set && this.state.destination_set) && (
                          <MapViewDirections
                            origin={this.state.origin_coordinates[0]}
                            destination={this.state.destination_coordinates[0]}
                            mode='DRIVING'
                            apikey={GOOGLE_MAPS_APIKEY}
                            strokeWidth={3}
                            strokeColor="hotpink"
                            optimizeWaypoints={true}                            
                            onReady={result => {
                              this.setState({distance: result.distance})
                              this.mapView.fitToCoordinates(result.coordinates, {
                                edgePadding: {
                                  right: (width / 20),
                                  bottom: (height / 20),
                                  left: (width / 20),
                                  top: (height / 20),
                                }
                              });
                            }}
                            onError={(error) => {
                              showError(error)
                            }}
                          />
                        )}
                    </MapView>                                              
                    <TextInput  
                        placeholder="Passengers (Number)"   
                        style={styles.input}  
                        keyboardType={'numeric'} 
                        value={this.state.passengers}
                        onChangeText={passengers => this.setState({ passengers })}
                    />  
                    <TextInput  
                        placeholder="Luggage (Number)"   
                        style={styles.input}  
                        keyboardType={'numeric'} 
                        value={this.state.luggage}
                        onChangeText={luggage => this.setState({ luggage })}
                    />  
                    <TextInput  
                        placeholder="Child seat (Number)"   
                        style={styles.input}  
                        keyboardType={'numeric'} 
                        value={this.state.childSeat}
                        onChangeText={childSeat => this.setState({ childSeat })}
                    />  
                    <Picker
                      selectedValue={this.state.cartype_id}
                      style={styles.input}
                      onValueChange={(item) =>
                        this.onChangeCarType(item)
                      }>
                      <Picker.Item label="Select a car" value="" />
                      {carTypes}
                    </Picker>                    
                    <Picker
                      selectedValue={this.state.card_id}
                      style={styles.input}
                      onValueChange={(item) =>
                        this.setState({card_id: item})
                      }>
                      <Picker.Item label="Select a card" value="" />
                      {cards}
                    </Picker>
                    <View style={{ flexDirection: 'row', marginTop: 10 }}>
                      <Text style={styles.price}>Price: USD {this.state.amount ? this.state.amount : '0.00'}</Text>
                    </View>
                    <View style={{ flexDirection: 'row', marginTop: 10 }}>
                        <CheckBox
                          value={this.state.checkAddComments}
                          onValueChange={() => this.setState({ checkAddComments: !this.state.checkAddComments })}
                        />
                        <Text style={{marginTop: 5}}> Add comments</Text>
                    </View>
                    {this.state.checkAddComments &&
                        <TextInput
                            placeholder="Comments" style={styles.TextInputStyleClass}
                            underlineColorAndroid="transparent"
                            numberOfLines={5}
                            multiline={true}
                            value={this.state.addComments}
                            onChangeText={addComments => this.setState({ addComments })}
                        />
                    }
                    <TouchableOpacity onPress={this.onCreate}>
                        <Text style={[styles.button,styles.buttonText]}>
                            Create ride
                        </Text>
                    </TouchableOpacity>
                </View>
            </ScrollView>
        );
    }
}

const styles = StyleSheet.create({
   container:{
       flex: 1,
       backgroundColor: '#cfe2f3',
       width: '100%',
       alignItems: 'center',
   },
   map: {    
    height: 100,
    width: '80%',
    marginTop: 10,
  },
   title: {    
        color: 'black',
        fontSize: 30,
        textAlign: 'center',
    },
    input: {
        width: '80%',
        height: 40,
        marginTop: 10,
        backgroundColor: 'white',
        paddingLeft: 5,
    },
    price: {
      width: '80%',
      height: 40,
      fontSize: 15,    
      textAlign: 'center',      
    },
    date: {
        width: '80%',
        marginTop: 10,
    },
    TextInputStyleClass:{
        marginTop: 10,
        marginBottom: 5,
        width: '80%',
        textAlign: 'center',
        height: 100,
        backgroundColor : "white",
    },
    button: {
        backgroundColor: '#080',
        marginTop: 5,
        padding: 10,
        alignItems: 'center',
        borderWidth: 1,
        borderColor: '#080',
        borderRadius: 6,
    },
    buttonText: {
        color: '#FFF',
        fontSize: 20,
        textAlign: 'center',
        marginBottom: 10,
    },
    iconBar: {
        marginTop: Platform.OS === 'ios' ? 30 : 20,
        marginHorizontal: 20,
        flexDirection: 'row',
        justifyContent: 'space-between',
    },
    suggestions: {
      backgroundColor: 'white',
      padding: 5,
      fontSize: 12,
      borderWidth: 0.5,
      marginLeft: 5,
      marginRight: 5,
      width: '80%',
    }
});