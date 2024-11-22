/**
 * @file
 * Integrates Views data with FullCalendar.
 */
(function (Drupal, drupalSettings, once) {
  Drupal.behaviors.fullcalendar = {
    attach(context, settings) {
      let slotDate = '';
      async function pushUpdate(data) {
        const url = `${drupalSettings.path.baseUrl}fullcalendar/ajax/update/drop/${data.entity_type}/${data.id}?_format=json`;
        let status = 400;
        delete data.entity_type;
        delete data.id;
        try {
          const response = await fetch(url, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
          });

          // @todo display messages returned to the user.
          const json = await response.json();
          if (response.ok) {
            return true;
            // eslint-disable-next-line no-else-return
          } else {
            status = response.status;
            throw new Error(`Response status: ${response.status}`);
          }
        } catch (error) {
          console.error(error.message);
        }
        return Promise.reject(new Error(status));
      }

      function displayMessage(text, success = true) {
        const toast = document.getElementById('fc-message');
        toast.innerHTML = text;
        toast.className = 'show';
        if (!success) {
          toast.className += ' error';
        }
        setTimeout(function () {
          toast.className = '';
        }, 5000);
      }

      function displaySuccess() {
        displayMessage(Drupal.t('Event updated'));
      }

      function revertInfo(info, notify) {
        info.revert();
        if (notify) {
          displayMessage(Drupal.t('Unable to update event'), false);
        }
      }

      // Event drop call back function.
      function eventProcess(info) {
        const end = info.event.end;
        const start = info.event.start;
        let strEnd = '';
        let strStart = '';
        const viewIndex = this.el.id;
        const viewSettings = drupalSettings.fullcalendar[viewIndex];
        if (info.event.extendedProps.type === 'smartdate') {
          strStart = info.event.startStr;
          strEnd = info.event.endStr;
        } else {
          const formatSettings = {
            month: '2-digit',
            year: 'numeric',
            day: '2-digit',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            timeZone: viewSettings.timeZone,
          };
          // define the end date string in 'YYYY-MM-DD' format.
          if (end) {
            // The end date of an all-day event is exclusive. For example, the end of
            // 2018-09-03 will appear to 2018-09-02 in the calendar. So we need one day
            // subtract to ensure the day stored in Drupal is the same as when it
            // appears in the calendar.
            if (
              end.getUTCHours() === 0 &&
              end.getUTCMinutes() === 0 &&
              end.getUTCSeconds() === 0
            ) {
              end.setDate(end.getDate() - 1);
            }
            // String of the end date.
            // eslint-disable-next-line no-undef
            strEnd = FullCalendar.formatDate(end, formatSettings);
          }
          // define the start date string in 'YYYY-MM-DD' format.
          if (start) {
            // eslint-disable-next-line no-undef
            strStart = FullCalendar.formatDate(start, formatSettings);
          }
        }

        if (viewSettings.updateConfirm) {
          const title = info.event.title.replace(/(<([^>]+)>)/gi, '');
          const msg = Drupal.t(
            '@title start is now @event_start and end is now @event_end - Do you want to save this change?',
            {
              '@title': title,
              '@event_start': strStart,
              '@event_end': strEnd,
            },
          );

          // eslint-disable-next-line no-restricted-globals
          if (!confirm(msg)) {
            info.revert();
            return;
          }
        }

        const data = {
          id: info.event.id,
          eid: info.event.extendedProps.eid,
          entity_type: viewSettings.entityType,
          start: strStart,
          end: strEnd,
          allDay: info.event.allDay,
          startField: info.event.extendedProps.startField,
          endField: info.event.extendedProps.endField,
          type: info.event.extendedProps.type,
          convertTzs: viewSettings.convertTzs,
          token: viewSettings.token,
        };
        const notify = viewSettings.showMessages ?? 0;
        const success = pushUpdate(data).then(
          function (v) {
            if (notify) {
              displaySuccess(info);
            }
          },
          function (e) {
            revertInfo(info, notify);
          },
        );
      }

      // Day entry click call back function.
      function dayClickCallback(info) {
        slotDate = info.dateStr;
      }

      function buildCalendars() {
        once('fullCalendarBuild', '.fullcalendar--wrapper', context).forEach(
          (calendarEl) => {
            const domId = calendarEl.id;
            if (drupalSettings.fullcalendar.hasOwnProperty(domId)) {
              const settings = drupalSettings.fullcalendar[domId];
              const calendarOptions = settings.options;
              calendarOptions.eventDrop = eventProcess;
              calendarOptions.eventResize = eventProcess;
              calendarOptions.headerToolbar = calendarOptions.header;
              calendarOptions.footerToolbar = calendarOptions.footer;
              calendarOptions.timeZone = settings.timeZone;
              calendarOptions.locale = settings.locale;
              if (
                settings.hasOwnProperty('addLink') &&
                settings.addLink !== ''
              ) {
                calendarOptions.dateClick = dayClickCallback;
                // Double click event.
                calendarEl.addEventListener('dblclick', function (e) {
                  const startField = settings.startField;
                  let url = `${drupalSettings.path.baseUrl}${settings.addLink}?start=${slotDate}&start_field=${startField}&destination=${window.location.pathname}`;
                  if (settings.formMode) {
                    url = `${url}&display=${settings.formMode}`;
                  }
                  if (slotDate) {
                    // Open a create link using the specified method.
                    if (settings.createTarget === 'modal') {
                      const ajaxWidth = settings.modalWidth ?? 600;
                      const ajaxSettings = {
                        url,
                        dialogType: settings.createTarget,
                        dialog: { width: ajaxWidth },
                      };
                      const myAjaxObject = Drupal.ajax(ajaxSettings);
                      myAjaxObject.execute();
                    } else {
                      window.open(url, '_self');
                    }
                  }
                });
              }
              // eslint-disable-next-line no-undef
              const calendar = new FullCalendar.Calendar(
                calendarEl,
                calendarOptions,
              );
              calendar.render();
            }
          },
        );
      }
      if (document.readyState !== 'loading') {
        // If the document is ready, build the calendars immediately.
        buildCalendars();
      } else {
        document.addEventListener('DOMContentLoaded', function () {
          // Otherwise, fire when loaded.
          buildCalendars();
        });
      }
    },
  };
})(Drupal, drupalSettings, once);
