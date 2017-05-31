/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 *
 * Date: 14/05/2017
 * Project: bigl.mpei.dev
 */

import { Notification } from 'element-ui';

export default (operation) => {

  let message = null;
  switch (operation) {
    case 'create':
      message = 'Запись создана'
      break
    case 'update':
      message = 'Запись обновлена'
      break
    case 'delete':
      message = 'Запись удалена'
      break
  }

  if (null !== message) {
    Notification({
      title: 'Информация',
      message,
      duration: 3 * 1000,
      offset: 70
    })
  }
}