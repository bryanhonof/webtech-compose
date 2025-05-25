#!/usr/bin/env bash

set -exo pipefail

function post_temperature() {
  local -r endpoint='https://api.open-meteo.com/v1/forecast?latitude=50.9654&longitude=5.6945&current=temperature_2m'
  local -r current_temp="$(curl $endpoint | jq --raw-output '.current.temperature_2m')"

  jo "value=$current_temp" | curl \
    --request POST \
    --json @- \
    'http://webserver:80/api/temperature'
}

function main() {
  while true; do
    post_temperature
    sleep 30
  done
}
main "$@"
