import csv
outFile = open('../result_2009_PC_swing.csv','wb')
writer = csv.writer(outFile, delimiter=',',quotechar='"', quoting=csv.QUOTE_ALL)

with open('IndiaVotes_PC__Karnataka_2009.csv','rb') as file:
	reader = csv.reader(file)
	rowNum = 0
	for row in reader:
		if rowNum == 0:
			rowNum += 1;
			continue;
		
		pcName = row[0];
		pcFileName="IndiaVotes_PC__"+('_'.join(pcName.split()))+"_2009.csv";
		print pcFileName;
		with open(pcFileName,'rb') as pcFile:
			pcReader = csv.reader(pcFile)
			pcRowNum = 0;
			votesTable = []
			#Store votes in memory
			for pcRow in pcReader:
				if pcRowNum ==0:
					pcRowNum += 1;
					continue;
				votesTable.append(pcRow);
				#pcRow.insert(0, pcName);
				pcRowNum += 1;
		
			
			#Calculate totals
			indepVotes = 0
			partyVotes = 0
			for pcRow in votesTable:
				if pcRow[4] == 'Independent':
					indepVotes += int(pcRow[2]);
				else:
					partyVotes += int(pcRow[2]);
					
			swingImpact = [pcName, round(100.0*float(indepVotes)/partyVotes,2)]
			writer.writerow(swingImpact);
			
			#Redistribute indep votes to others
			for pcRow in votesTable:
				if pcRow[4] == 'Independent':
					pcRow.append(0)
					pcRow.append('0%')
				else:
					newVotes = float(pcRow[2]) + indepVotes * int(pcRow[2]) / partyVotes
					newPercent = 100*newVotes / partyVotes
					pcRow.append(round(newVotes))
					pcRow.append(str(round(newPercent, 2))+'%')
				#writer.writerow(pcRow);

		rowNum += 1