#!/bin/bash
#source ../venv/bin/activate
export PYTHONPATH=./rasaaddons:$PYTHONPATH
rasa run -m models --enable-api --cors "*" --debug -p 5005
