




function exec_mirador_actions(path, nlp_action, miradorInstance) {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
       mirador_actions = JSON.parse(xhr.responseText);
       mirador_actions.forEach(json_action =>  exec_mirador_action(json_action.action, miradorInstance));
       
      }
      else {
        error(xhr);
      }
    }
  };
  xhr.open('GET', path+"?nlp_action="+nlp_action, true);
  xhr.send();
}


        

 

function exec_mirador_action(action, miradorInstance)
	{
 
			
			switch (action.type)
			
				{	
					case "SELECT_ANNOTATION" :
					actionTranslation="selectAnnotation";
					console.log("annotation");
					action1 = eval("Mirador.actions. " + actionTranslation + "('" + action.parameters.window_id + "', '" + action.parameters.argument + "')");
					break;

					case "ZOOM_WINDOW" : 
					actionTranslation="updateViewport";
					console.log("upview");
					action1 = eval("Mirador.actions. " + actionTranslation + "('" + action.parameters.window_id + "'," + action.parameters.argument + ")");
					break;

					case "CHANGE_CANVAS" : 
					actionTranslation="setCanvas";
					console.log("change canvas");
					action1 = eval("Mirador.actions. " + actionTranslation + "('" + action.parameters.window_id + "','" +  action.parameters.argument + "')");
				
					break;

					case "CHANGE_MANIFEST" : 
					actionTranslation="addResource";
					console.log("add manifest");
					action1 = eval("Mirador.actions. " + actionTranslation + "(" +  action.parameters.argument + "')");
			
					break;

					//no action
					case "NO_ACTION" : 
					actionTranslation="";
					console.log("no action");
				
					break;

					default :
					 console.log("ERROR: syntax error(s) or action not supported");
					 return;
					
					
					
					
			}

		miradorInstance.store.dispatch(action1);

	
	}


	
