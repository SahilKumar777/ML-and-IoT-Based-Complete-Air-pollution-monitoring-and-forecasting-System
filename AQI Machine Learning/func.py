import numpy as np 
import pandas as pd 
import seaborn as sns
from matplotlib import pyplot as plt
from matplotlib import style
from sklearn import linear_model
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import LabelEncoder
from sklearn.preprocessing._data import MinMaxScaler
from datetime import datetime

def series_to_supervised(data,pred_list, n_in=1, n_out=1, dropnan=True):
 n_vars = 1 if type(data) is list else data.shape[1]
 n_pred = len(pred_list)
 df = pd.DataFrame(data)
 cols, names = list(), list()
 # input sequence (t-n, ... t-1)
 for i in range(n_in, 0, -1):
     cols.append(df.shift(i))
     names += [('var%d(t-%d)' % (j+1, i)) for j in range(n_vars)]
 # forecast sequence (t, t+1, ... t+n)
 for i in range(0, n_out):
     if n_pred == 1 :
         cols.append(df[pred_list[0]].shift(-i))
     else:
         cols.append(df[pred_list].shift(-i))
        
     if i == 0:
         names += [('varp%d(t)' % (j+1)) for j in range(n_pred)]
     else:
         names += [('varp%d(t+%d)' % (j+1, i)) for j in range(n_pred)]
 # put it all together
 agg = pd.concat(cols, axis=1)
 agg.columns = names
 # drop rows with NaN values
 if dropnan:
     agg.dropna(inplace=True)
 return agg




def windowData(data,pred_list,n_steps_in,n_steps_out):
    n_features=data.shape[1]
    ### resampling data
    
    df_resample = data.resample('h').mean() 
    K=df_resample.isna().sum(axis=1)>3
    l=[]
    for i in df_resample.index:
        if K[i]==True:
            l.append(i)
    df_resample=df_resample.drop(l)
    
    ### reframing time series data
    
    values = df_resample.values
    # integer encode direction
    # encoder = LabelEncoder()
    # values[:,4] = encoder.fit_transform(values[:,4])
    # ensure all data is float
    values = values.astype('float32')
    # normalize features
    
    scaler = MinMaxScaler(feature_range=(0, 1))
    scaled = scaler.fit_transform(values)
    # frame as supervised learning
    reframed = series_to_supervised(scaled,pred_list,n_steps_in, n_steps_out)
    
    ### split into train test
    values = reframed.values
    n_train_hours = 10 * 24
    train = values[:n_train_hours, :]
    test = values[n_train_hours:, :]
    # split into input and outputs
    train_X, train_Y = train[:, :n_features*n_steps_in], train[:,n_features*n_steps_in :]
    test_X, test_Y = test[:, :n_features*n_steps_in], test[:,n_features*n_steps_in:]
    # reshape input to be 3D [samples, timesteps, features]
    train_X = train_X.reshape((train_X.shape[0], n_steps_in, n_features))
    test_X = test_X.reshape((test_X.shape[0], n_steps_in, n_features))
    
    return train_X,train_Y,test_X,test_Y,scaler
