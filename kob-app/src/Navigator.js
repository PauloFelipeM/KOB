import React from 'react';
import { createSwitchNavigator, createDrawerNavigator } from 'react-navigation';
import AuthOrApp from './screens/AuthOrApp';
import Main from './screens/Main';
import Card from './screens/Card';
import Auth from './screens/Auth';
import CardSquare from './screens/CardSquare';
import Bookings from './screens/Bookings';
import commonStyles from './commonStyles';
import Menu from './screens/Menu';

const MenuRoutes = {
    Main: {
        name: 'Main',
        screen: props => <Main title="Book a ride" {...props}/>,
        navigationOptions: {
            title: 'Book a Ride'
        }
    },
    Card: {
        name: 'Card',
        screen: props => <Card title="Payment Methods" {...props}/>,
        navigationOptions: {
            title: 'Payment Methods'
        }
    },
    Bookings: {
        name: 'Bookings',
        screen: () => <Bookings title="My Bookings"/>,
        navigationOptions: {
            title: 'My Bookings'
        }
    },

}

const MenuConfig = {
    initialRouteName: 'Main',
    contentComponent: Menu,
    contentOptions: {
        labelStyle: {
            fontFamily: commonStyles.fontFamily,
            fontWeight: 'normal',
            fontSize: 20,
        },
        activeLabelStyle: {
            color: '#080',
        }
    }
}

const MenuNavigator = createDrawerNavigator(MenuRoutes, MenuConfig);

const MainRoutes = {
    Loading: {
        name: 'Loading',
        screen: AuthOrApp,
    },
    Auth:{
        name: 'Auth',
        screen: Auth
    },
    Main:{
        name: 'Main',
        screen: MenuNavigator
    },
    Card:{
        name: 'Card',
        screen: Card
    },
    Bookings:{
        name: 'Bookings',
        screen: Bookings
    },
    CardSquare:{
        name: 'CardSquare',
        screen: CardSquare
    },
}


const MainNavigator = createSwitchNavigator(MainRoutes, {     
     initialRouteName: 'Loading'
});


export default MainNavigator;