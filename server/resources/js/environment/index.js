const config = require('./_' + process.env.NODE_ENV);

export default class Environment {
  static get API_KEY() {
    return config.API_KEY
  }
}
