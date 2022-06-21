# This files contains your custom actions which can be used to run
# custom Python code.
#
# See this guide on how to implement these action:
# https://rasa.com/docs/rasa/custom-actions


# This is a simple example for a custom action which utters "Hello World!"

# from typing import Any, Text, Dict, List
#
from rasa_sdk import Action, Tracker
from rasa_sdk.executor import CollectingDispatcher
from rasa_sdk.events import SlotSet
import json

class setTopic(Action):

    def name(self):
        return "action_set_Topic"

    def run(self, dispatcher, tracker, domain):
        link_page = tracker.get_slot("page_url")     

        return[SlotSet("topic", link_page)]



class get_and_send_Topic(Action):

    def name(self):
        return "send_Topic"

    def run(self, dispatcher, tracker, domain):
        get_topic = tracker.get_slot("topic")
        get_page = tracker.get_slot("page_url")

        print(get_topic)
        print(get_page)

        if (get_topic == 'arch') and (get_page == 'arch'):
            return []           
        
        elif (get_topic == 'arch') and (get_page != 'arch'):
            j = '{"action" : {"type" : "CHANGE_CANVAS", "parameters" : {"window_id": "main_window", "argument" : "https://parsec2.unicampania.it/cleopatra/cleodemo/summerschool/index.json/canvas/0"}}}'

        elif (get_topic == 'fattori') and (get_page == 'fattori'):
            return []           
        
        elif (get_topic == 'fattori') and (get_page != 'fattori'):    
            j = '{"action" : {"type" : "CHANGE_CANVAS", "parameters" : {"window_id": "main_window", "argument" : "https://parsec2.unicampania.it/cleopatra/cleodemo/summerschool/index.json/canvas/4"}}}'           

        elif (get_topic == 'conocchia') and (get_page == 'conocchia'):
            return []           
        
        elif (get_topic == 'conocchia') and (get_page != 'conocchia'):  
            j = '{"action" : {"type" : "CHANGE_CANVAS", "parameters" : {"window_id": "main_window", "argument" : "https://parsec2.unicampania.it/cleopatra/cleodemo/summerschool/index.json/canvas/5"}}}'
          
        elif (get_topic == 'cryptoporticus') and (get_page == 'cryptoporticus'):
            return []           
        
        elif (get_topic == 'cryptoporticus') and (get_page != 'cryptoporticus'):  
            j = '{"action" : {"type" : "CHANGE_CANVAS", "parameters" : {"window_id": "main_window", "argument" : "https://parsec2.unicampania.it/cleopatra/cleodemo/summerschool/index.json/canvas/9"}}}'        

        elif (get_topic == 'domus_confuleius') and (get_page == 'domus_confuleius'):
            return []           
        
        elif (get_topic == 'domus_confuleius') and (get_page != 'domus_confuleius'):     
            j = '{"action" : {"type" : "CHANGE_CANVAS", "parameters" : {"window_id": "main_window", "argument" : "https://parsec2.unicampania.it/cleopatra/cleodemo/summerschool/index.json/canvas/12"}}}'         

        elif (get_topic == 'second_confuleius') and (get_page == 'second_confuleius'):
            return []           
        
        elif (get_topic == 'second_confuleius') and (get_page != 'second_confuleius'):
            j = '{"action" : {"type" : "CHANGE_CANVAS", "parameters" : {"window_id": "main_window", "argument" : "https://parsec2.unicampania.it/cleopatra/cleodemo/summerschool/index.json/canvas/13"}}}'

        elif (get_topic == 'first_confuleius') and (get_page == 'first_confuleius'):
            return []           
        
        elif (get_topic == 'first_confuleius') and (get_page != 'first_confuleius'):
            j = '{"action" : {"type" : "CHANGE_CANVAS", "parameters" : {"window_id": "main_window", "argument" : "https://parsec2.unicampania.it/cleopatra/cleodemo/summerschool/index.json/canvas/13"}}}'             

        elif (get_topic == 'domus_orti') and (get_page == 'domus_orti'):
            return []           
        
        elif (get_topic == 'domus_orti') and (get_page != 'domus_orti'):
            j = '{"action" : {"type" : "CHANGE_CANVAS", "parameters" : {"window_id": "main_window", "argument" : "https://parsec2.unicampania.it/cleopatra/cleodemo/summerschool/index.json/canvas/15"}}}'           

        elif (get_topic == 'theater') and (get_page == 'theater'):
            return []           
        
        elif (get_topic == 'theater') and (get_page != 'theater'):
            j = '{"action" : {"type" : "CHANGE_CANVAS", "parameters" : {"window_id": "main_window", "argument" : "https://parsec2.unicampania.it/cleopatra/cleodemo/summerschool/index.json/canvas/17"}}}'               

        elif (get_topic == 'peculiaris') and (get_page == 'peculiaris'):
            return []           
        
        elif (get_topic == 'peculiaris') and (get_page != 'peculiaris'):   
            j = '{"action" : {"type" : "CHANGE_CANVAS", "parameters" : {"window_id": "main_window", "argument" : "https://parsec2.unicampania.it/cleopatra/cleodemo/summerschool/index.json/canvas/19"}}}'        

        else:
            dispatcher.utter_message("What topic you are insterested in? (Arch, connocchia, domus, theather)") 
            return[]        

        dispatcher.utter_message(attachment = j)                     

        return []