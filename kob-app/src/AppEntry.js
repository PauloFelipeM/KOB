import { registerRootComponent } from 'expo';
import { activateKeepAwake } from 'expo-keep-awake';

import Navigator from './Navigator';

if (__DEV__) {
  activateKeepAwake();
}

registerRootComponent(Navigator);
